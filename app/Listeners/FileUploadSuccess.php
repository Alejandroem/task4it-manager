<?php

namespace App\Listeners;

use Jasekz\Laradrop\Events\FileWasUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Debugbar;
use Jasekz\Laradrop\Models\File;

class FileUploadSuccess
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FileWasUploaded  $event
     * @return void
     */
    public function handle(FileWasUploaded $event)
    {
        //
        $file = $event->data["file"];
        $object = json_decode($event->data["postData"]["customData"]);
        foreach($object->form as $input)
            $file[$input->name] = $input->value;
        $file->save();
        
    }
}
