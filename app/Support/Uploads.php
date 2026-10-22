<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Uploads
{
    /** Saves an admin upload under public/uploads/admin and returns its public path. */
    public static function store(UploadedFile $file): string
    {
        $dir = 'uploads/admin/'.now()->format('Y/m');

        // Serverless hosts such as Vercel have a read-only disk
        if (! is_writable(public_path('uploads'))) {
            throw ValidationException::withMessages([
                'upload' => 'Image uploads are not available on this host. Add the image to public/uploads in the repository instead.',
            ]);
        }

        $name = Str::random(12).'-'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->guessExtension();
        $file->move(public_path($dir), $name);

        return '/'.$dir.'/'.$name;
    }
}
