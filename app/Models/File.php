<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['filename', 'filepath', 'entity_type', 'entity_id', 'ext', 'alt'];
    
    public function getIconAttribute()
    {
        return $this->getIcon($this->filename);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($file) { 
            if (FacadesFile::exists($file->filepath)):
                FacadesFile::delete($file->filepath);
            endif;
        });
    }

    public function getIcon($filename)
    {
        $lastDotPosition = strrpos($filename, '.');
        if ($lastDotPosition === false || $lastDotPosition === 0):
            return 'file';
        endif;
        $ext = strtolower(substr($filename, $lastDotPosition + 1));
    
        switch ($ext):
            case 'pdf':
                return 'pdf';
            case 'doc':
            case 'docx':
            case 'rtf':
                return 'doc';
            case 'jpeg':
            case 'jpg':
            case 'png':
            case 'bmp':
                return 'jpg';
            case 'xls':
            case 'xlsx':
                return 'xls';
            default:
                return 'file';
        endswitch;
    }
}
