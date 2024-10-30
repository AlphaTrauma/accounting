<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'status'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($model) {
             $model->files()->delete();
        });
    }

    public function files(){
        return $this->morphMany(File::class, 'entity');
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
