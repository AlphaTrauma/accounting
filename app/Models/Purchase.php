<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'guide_id', 'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function guide(){
        return $this->belongsTo(Guide::class);
    }
}