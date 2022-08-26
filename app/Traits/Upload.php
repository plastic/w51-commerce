<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Upload
{
    public function upload($file, $directory, $type = 'image')
    {
        $image = $file;
        $name = time() . '-' . $type . '.' . $image->getClientOriginalExtension();
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

    public function handleQuillImages($conteudo,$imagens,$path){

        preg_match_all("/\<\w[^<>]*?\>([^<>]+?\<\/\w+?\>)?|\<\/\w+?\>/i", $conteudo, $matches);

            foreach ($matches[0] as $matche){

                if (str_contains($matche , '<img')) {
                    preg_match('/src="([^"]+)/i',$matche, $imgage);
                    $imgName = str_ireplace( 'src="', '',  $imgage[0]);

                        foreach ($imagens as $key => $image) {
                            if($image->getClientOriginalName() == $imgName){
                                $returnName = $this->upload($image, $path, str_replace('.','',$imgName));
                                // if (!$image) {
                                //     return response()->json("Ocorreu um erro ao enviar o arquivo", 400);
                                // }
                                $newName = '/imagens'.'/'.$path.'/'.$returnName;

                                $newmatche = str_ireplace( $imgName, $newName ,  $matche);

                                $conteudo = str_ireplace( $matche , $newmatche , $conteudo);

                            }
                        }
                }
            }

        return $conteudo;
    }
}
