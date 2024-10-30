<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function upload(Request $request)
    {
        $uploadedFiles = $request->file('file'); 
        $files = []; 

        foreach ($uploadedFiles as $uploadedFile) {
            $filename = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadPath = $this->isImage($uploadedFile) ? 'upload/images' : 'upload/files';

            if (!FileFacade::exists($uploadPath)) {
                FileFacade::makeDirectory($uploadPath, 0755, true);
            }

            if ($this->isImage($uploadedFile) && !$request['uncompressed']) {
                $this->compressImage($uploadedFile, public_path($uploadPath), $filename);
            } else {
                Storage::disk('public')->put($uploadPath . '/' . $filename, file_get_contents($uploadedFile));
            }

            if ($request['replace']) {
                File::where('entity_type', $request['entity_type'])
                    ->where('entity_id', $request['entity_id'])->delete();
            }

            $file = new File([
                'filepath' => '/' . $uploadPath . '/' . $filename,
                'filename' => $uploadedFile->getClientOriginalName(),
                'ext' => $uploadedFile->getClientOriginalExtension(),
                'entity_type' => $request->input('entity_type')
            ]);

            if ($request->has('entity_id')) {
                $file->entity_id = $request['entity_id'];
            }

            $file->save();
            $files[] = $file;
        }
       
        return response(['files' => $files]);
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

    public function update(Request $request, $id)
    {
        $file = File::find($id);
        $fields = $request->all();
        if ($request->has('filename')):
            $fields['filename'] = trim($fields['filename']) . '.' . pathinfo($file->filename, PATHINFO_EXTENSION);
        endif;
        $file->update($fields);

        return response(['file' => $file]);
    }
    public function download($id)
    {
        $file = File::find($id);
        return Storage::disk('public')->download($file->filepath, $file->filename);
    }

    public function remove(Request $request)
    {
        $file = File::find($request['id']);
        if ($file):
            if(self::checkPurchases($file)):
                return response(['status' => false]);
            else:
                $file->delete();
                return response(['status' => true]);
            endif;
            
        endif;
    }

    public function list(Request $request)
    {
        $data = $request->all();
        $class = $data['class'];
        $id = $data['id'];
        $files = app('App\Models\\' . $class)::with('files')->find($id)->files->sortByDesc('created_at') ?? [];

        return response(['files' => $files->toArray()]);
    }

    private static function checkPurchases($file){
        # пока всегда false.
        return false;
        if($file->entity_type === "App\Models\Guide"):
            $purchasesCount = Purchase::where('guide_id', $file->entity_id)->count();
            return !!$purchasesCount;
        endif;
        return false;
    }

    
}
