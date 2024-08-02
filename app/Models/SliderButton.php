<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderButton extends Model
{
    use HasFactory; 
    public $timestamps = false;

    protected $fillable = ['text', 'class', 'url', 'slide_id'];

    public function slide(){
        return $this->belongsTo(SliderItem::class, 'slide_id');
    }
}
