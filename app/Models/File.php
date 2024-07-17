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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($file) { 
            if (FacadesFile::exists($file->filepath)):
                FacadesFile::delete($file->filepath);
            endif;
        });
    }
}
