<?php

namespace App\Http\Controllers;

// use App\File;
use Illuminate\Http\Request;
use Jasekz\Laradrop\Models\File;
use Debugbar;
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
            // $files = File::where('parent_id',$request->pid)
            // ->get();
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
        try {            
            $fileData['alias'] = $request->filename ? $request->filename : date('m.d.Y - G:i:s');
            $fileData['type'] = 'folder';
            // $fileDate['relation']= Input::get('relation');
            // $fileDate['relation_id']= Input::get('relation_id');
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
