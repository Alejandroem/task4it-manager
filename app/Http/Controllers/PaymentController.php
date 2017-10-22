<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Jasekz\Laradrop\Models\File;
use Storage, Auth;
use Intervention\Image\ImageManagerStatic as Image;
class PaymentController extends Controller
{   
    
    public function __construct()
    {
        $this->middleware(['role:admin|project-manager|client']);        
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
        if (Auth::user()->hasAnyRole('admin')) {
            $payments = Payment::all();
        } else {
            $payments = Payment::where('user_id',Auth::id())->get();
        }
        return view('payments.index')->with(compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $payment = new Payment();
        return view('payments.create')->with(compact('payment'));
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
        $request->validate([
            'description'=>'required',
            'file'=>'required',
            'amount'=>'required|numeric'
        ]);

        try {
            
            if (! $request->hasFile('file')) {
                throw new \Exception(trans('err.fileNotProvided'));
            }
            
            if( ! $request->file('file')->isValid()) {
                throw new \Exception(trans('err.invalidFile'));
            }

            $payment = Payment::create([
                'user_id'=>Auth::id(),
                'description'=>$request->description,
                'amount'=>$request->amount
            ]);
            $user = Auth::user();
            $user->balance -= $request->amount;
            $user->save();
            
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
            $file->relation = 'payment';
            $file->relation_id = $payment->id;
            $file->save();

            /*
                * fire 'file uploaded' event
                */

            
            return redirect()->route('payments.index');
            
        } 

        catch (\Exception $e) {
            
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
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
