<?php

namespace App\Http\Controllers;

// use App\File;
use Illuminate\Http\Request;
use Jasekz\Laradrop\Models\File;
use Jasekz\Laradrop\Events\FileWasDeleted;
use Intervention\Image\ImageManagerStatic as Image;
use Debugbar;
use Storage, Auth;
class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        try {
            $out = [];            
            if(File::count() && $request->pid > 0) {
                $files = File::where('id', '=', $request->pid)
                ->first()
                ->immediateDescendants()
                ->where('relation',$request->relation)
                ->where('relation_id',$request->relation_id)
                ->get();
            } else if(File::count()) {
                $files = File::orderBy('parent_id')
                ->first()
                ->getSiblingsAndSelf()
                ->where('relation',$request->relation)
                ->where('relation_id',$request->relation_id);
            }
            if(isset($files)) {
                foreach($files as $file) {
                    if( $file->has_thumbnail && config('laradrop.disk_public_url')) {
                        
                        $publicResourceUrlSegments = explode('/', $file->public_resource_url);
                        $publicResourceUrlSegments[count($publicResourceUrlSegments) - 1] = '_thumb_' . $publicResourceUrlSegments[count($publicResourceUrlSegments) - 1];
                        $file->filename = implode('/', $publicResourceUrlSegments); 
                    
                    } else {
                        $file->filename = config('laradrop.default_thumbnail_url');
                    }
                    
                    $file->numChildren = $file->children()->count();
                    
                    if($file->type == 'folder') {
                        array_unshift($out, $file);
                    } else {
                        $out[] = $file;
                    }
                }
            }
            return response()->json([
                'status' => 'success',
                'data' => $out,
            ]);
        }
        catch (Exception $e) {
            return $this->handleError($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPOST(String $relation, String $relation_id, Request $request)
    {
        //
        Debugbar::info("Request name ", $request);
        try {            
            $fileData['alias'] = $request->filename ? $request->filename : date('m.d.Y - G:i:s');
            $fileData['type'] = 'folder';
            if($request->pid > 0) {
                $fileData['parent_id'] = $request->pid;
            }
            $file = File::create($fileData);
            $file->relation = $relation;
            $file->relation_id = $relation_id;
            $file->save();

            return response()->json([
                'status' => 'success'
            ]);
        }
        catch (Exception $e) {
            return $this->handleError($e);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            if (! $request->hasFile('file')) {
                throw new Exception(trans('err.fileNotProvided'));
            }
            
            if( ! $request->file('file')->isValid()) {
                throw new Exception(trans('err.invalidFile'));
            }
            
            /*
             * move file to temp location
             */
            $fileExt = $request->file('file')->getClientOriginalExtension();
            $fileName = str_replace('.' . $fileExt, '', $request->file('file')->getClientOriginalName()) . '-' . date('Ymdhis');
            $mimeType = $request->file('file')->getMimeType();
            $tmpStorage = storage_path();
            $movedFileName = $fileName . '.' . $fileExt;
            $fileSize = $request->file('file')->getSize();

            if($fileSize > ( (int) config('laradrop.max_upload_size') * 1000000) ) {
                throw new Exception(trans('err.invalidFileSize'));
            }
            
            $request->file('file')->move($tmpStorage, $movedFileName);
            
            $disk = Storage::disk(config('laradrop.disk'));

            /*
             * create thumbnail if needed
             */
            $fileData['has_thumbnail'] = 0;
            if ($fileSize <= ( (int) config('laradrop.max_thumbnail_size') * 1000000) && in_array($mimeType, ["image/jpg", "image/jpeg", "image/png", "image/gif"])) {

                $thumbDims = config('laradrop.thumb_dimensions');
                $img = Image::make($tmpStorage . '/' . $movedFileName);
                $img->resize($thumbDims['width'], $thumbDims['height']);
                $img->save($tmpStorage . '/_thumb_' . $movedFileName);

                // move thumbnail to final location
                $disk->put('_thumb_' . $movedFileName, fopen($tmpStorage . '/_thumb_' . $movedFileName, 'r+'));
                Storage::delete($tmpStorage . '/_thumb_' . $movedFileName);                
                $fileData['has_thumbnail'] = 1;
                
            } 

            /*
             * move uploaded file to final location
             */
            $disk->put($movedFileName, fopen($tmpStorage . '/' . $movedFileName, 'r+'));
            Storage::delete($tmpStorage . '/' . $movedFileName);
            
            /*
             * save in db
             */          
            $fileData['filename'] = $movedFileName;  
            $fileData['alias'] = $request->file('file')->getClientOriginalName();
            $fileData['public_resource_url'] = config('laradrop.disk_public_url') . '/' . $movedFileName;
            $fileData['type'] = $fileExt;
            if($request->pid > 0) {
                $fileData['parent_id'] = $request->pid;
            }
            $meta = $disk->getDriver()->getAdapter()->getMetaData($movedFileName);
            $meta['disk'] = config('laradrop.dfileisk');
            $fileData['meta'] = json_encode($meta);
            
            $file = File::create($fileData);
            if($request->relation=="avatar"){
                $oldAvatar = File::where('relation_id',Auth::id())
                ->where('relation','avatar')
                ->first();
                if($oldAvatar){
                    $disk->delete($oldAvatar->filename);
                    $disk->delete('_thumb_' . $oldAvatar->filename);
                    $oldAvatar->delete();
                }
            }

            $file->relation = $request->relation;
            $file->relation_id = $request->relation_id;
            $file->save();
            
            
            /*
             * fire 'file uploaded' event
             */

            
            return back();
            
        } 

        catch (Exception $e) {
            
            // delete the file(s)
            if( isset($disk) && $disk) {
                $disk->delete($movedFileName);
                $disk->delete('_thumb_' . $movedFileName);
            }
            
            return $this->handleError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
        Debugbar::info($file);
        //return response()->download($file->public_resource_url);
        return $file->public_resource_url;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
        Debugbar::info("update",$request->filename,$file);
        try {
            $file->filename = $request->filename;
            $file->alias = $request->filename;
            $file->save();

            return response()->json([
                'status' => 'success'
            ]);
        } 

        catch (Exception $e) {
            return $this->handleError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        if(Auth::user()->hasAnyRole('admin|projectm|developer')){
            //
            try{
                $disk = Storage::disk(config('laradrop.disk'));
                if($file->descendants()->exists()) {
                    foreach($file->descendants()->where('type', '!=', 'folder')->get() as $descendant) {
                        $disk->delete('_thumb_'.$file->filename);        
                        $disk->delete($file->filename);        
                        event(new FileWasDeleted([ // fire 'file deleted' event for each descendant
                            'file' => $descendant
                        ]));
                    }
                }
                $disk->delete('_thumb_'.$file->filename);
                $disk->delete($file->filename);
                $file->delete();

                if($file->type != 'folder') {
                    event(new FileWasDeleted([ // fire 'file deleted' event for file
                        'file' => $file
                    ]));
                }
            
                return response()->json([
                    'status' => 'success'
                ]);
            } 

            catch (Exception $e) {
                return $this->handleError($e);
            }
        }else{
            return response()->json([
                'status' => 'success'
            ]);
        }

    }
}
