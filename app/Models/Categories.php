<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'slug', 'open'];

    public function articles(){
        return $this->hasMany(Article::class, 'category_id');
    }
}
