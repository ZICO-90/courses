<?php

namespace App\Http\Traits;
use Illuminate\Support\Facades\File;
trait ImagesTrait

{
    private function uploadImage($file, $fileName, $path, $oldFile = null)
    {
        $file->move(public_path($path), $fileName);

        if(!is_null($oldFile))
        {
            File::delete((public_path($oldFile)));
        }
    }
}
