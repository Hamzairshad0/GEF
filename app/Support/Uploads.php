<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class Uploads
{
    /** Saves an admin upload under public/uploads/admin and returns its public path. */
    public static function store(UploadedFile $file): string
    {
        $dir = 'uploads/admin/'.now()->format('Y/m');
        $name = Str::random(12).'-'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->guessExtension();
        $file->move(public_path($dir), $name);

        return '/'.$dir.'/'.$name;
    }
}
