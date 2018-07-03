<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use App\User;
use App\Project;
use Auth;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Jasekz\Laradrop\Models\File;
use Jasekz\Laradrop\Events\FileWasDeleted;
use \Carbon\Carbon;
class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:admin|developer']);        
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->hasAnyRole('admin')){
            $developers = User::with('roles')->get();
            $developers = $developers->reject(function($user,$key){
                return $user->hasRole('developer');
            });
        }else{
            $developers = \App\User::where('id',Auth::id())->get();
        }
        return view('invoices.index')->with(compact('developers'));
    }

    public function invoicesList(Project $project,User $developer){
        return view('invoices.list')->with(compact('project','developer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //$projects = User::find($request->user)->projects->pluck('id','name');


        $projects = Auth::user()->projects()->pluck('name','id');
        return view('invoices.create')->with(compact('projects'));
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
        $this->validate($request,[
            'project'=>'required',
            'date'=>'required',
            'amount'=>'required',
            'file'=>'required'
        ]);

        try {

            if (! $request->hasFile('file')) {
                throw new \Exception(trans('err.fileNotProvided'));
            }
            
            if( ! $request->file('file')->isValid()) {
                throw new \Exception(trans('err.invalidFile'));
            }

            $invoice = Invoice::create([
                'project_id'=>$request->project,
                'user_id'=>Auth::id(),
                'date'=>Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d'),
                'amount'=>$request->amount
            ]);
            
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
                throw new \Exception(trans('err.invalidFileSize'));
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

            $file->relation = 'invoice';
            $file->relation_id = $invoice->id;
            $file->save();
            /*
             * fire 'file uploaded' event
             */
            return redirect()->route('invoices.index');
        } 
        catch (Exception $e) {      
            // delete the file(s)
            if( isset($disk) && $disk) {
                $disk->delete($movedFileName);
                $disk->delete('_thumb_' . $movedFileName);
            }         
            return $e;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
