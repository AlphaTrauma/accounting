<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; 

class FilesController extends Controller
{
    public function upload(Request $request)
    { 
        # Загрузка файла
        $uploadedFile = $request->file('file'); 
        $filename = uniqid() . '.' . $uploadedFile->getClientOriginalExtension(); 
        $uploadPath = $this->isImage($uploadedFile) ? 'upload/images' : 'upload/files'; 
        if (!FileFacade::exists($uploadPath)) {
            FileFacade::makeDirectory($uploadPath, 0755, true);
        }
        if ($this->isImage($uploadedFile)):
            $this->compressImage($uploadedFile, public_path($uploadPath), $filename);
        else: 
            $uploadedFile->storeAs(public_path($uploadPath), $filename);
        endif;
        $file = new File([
            'filepath' => '/'.$uploadPath.'/'. $filename,
            'filename' => $filename,
            'ext' => $uploadedFile->getClientOriginalExtension(), 
            'entity_type' => $request->input('entity_type')
        ]); 
        if($request->has('entity_id')):
            $file->entity_id = $request['entity_id'];
        endif;
        $file->save(); 

        return response(['file' => $file]);
    }

    # Метод для сжатия изображения
    private function compressImage($file, $uploadPath, $filename)
    { 
       $image = imagecreatefromstring(file_get_contents($file->getRealPath()));

       $width = imagesx($image);
       $height = imagesy($image);

       $maxWidth = 1920;
       $maxHeight = 1080;

       if ($width > $maxWidth || $height > $maxHeight):
           $ratio = min($maxWidth / $width, $maxHeight / $height);
           $newWidth = $width * $ratio;
           $newHeight = $height * $ratio;
           $newImage = imagecreatetruecolor($newWidth, $newHeight);
           imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
           imagejpeg($newImage, $uploadPath . '/' . $filename, 90);
           imagedestroy($newImage);
       else: 
           imagejpeg($image, $uploadPath . '/' . $filename, 90);

       endif;

       imagedestroy($image);
    }

    # Метод для проверки, является ли файл изображением
    private function isImage($file)
    {
        $imageMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        return in_array($file->getMimeType(), $imageMimeTypes);
    }
} 
