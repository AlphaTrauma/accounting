<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'meta_title', 'meta-description', 'content', 'category_id', 'views', 'user_id', 'published_at'];
    protected $casts = ['published_at' => 'datetime'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->morphMany(File::class, 'entity');
    }

    public function category(){
        return $this->belongsTo(Categories::class, 'category_id');
    }
 
}
