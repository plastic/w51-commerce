<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Upload
{
    public function upload($file, $directory, $type = 'image')
    {
        $image = $file;
        $name = $type . '-' .  time() . '.' . $image->getClientOriginalExtension();
        $filePath = public_path('imagens/'.$directory.'/');

        try {
            Storage::disk('disk')->put('imagens/'.$directory.'/' . $name, file_get_contents($file), [
                'ContentDisposition' => 'attachment',
                'visibility' => 'public',
            ]);

        } catch (\Exception $e) {
            $image->move($filePath, $name);
        }

        return $name;
    }

    public function uploadCatalog($file, $type = 'image')
    {
        $name = $file->getClientOriginalName() . '-' .time() . '-' . $type . '.' . $file->getClientOriginalExtension();
        $filePath = public_path('/uploads');

        try {
            Storage::disk('disk')->put('uploads/' . $name, file_get_contents($file), [
                'ContentDisposition' => 'attachment',
                'visibility' => 'public',
            ]);

        } catch (\Exception $e) {
            $file->move($filePath, $name);
        }

        return 'uploads/' . $name;
    }
}
