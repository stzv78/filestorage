<?php

namespace App\Models\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\File;

trait FileTrait
{
    public static function fileUpload(Request $request)
    {
        if ($request->hasFile('file') && $request->file->isValid()) {

            $file = $request->file;

            //hashName() возврщает 40симв., хеширование md5 для 32 символов
            //$name = $request->file->getClientOriginalName();
            //$hashFile = hash('md5', $name);
            $hashFile = $request->file->hashName();
            $hashUser = hash('md5', $request->userEmail);

            File::create([
                'description' => $request->description,
                'hash_user' => $hashUser,
                'hash_file' => $hashFile,
            ]);
            $path = "uploaded/$hashUser";

            return $file->store($path) ? asset("$path/$hashFile") : false;
        };
    }
}