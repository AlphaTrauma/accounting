<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title', 'subtitle', 'text', 'status', 'order', 'positioning', 'color1', 'color2', 'text_color', 'size'];

    public function buttons(){
        return $this->hasMany(SliderButton::class, 'slide_id');
    }

    public function image(){
        return $this->morphOne(File::class, 'entity');
    }
}
