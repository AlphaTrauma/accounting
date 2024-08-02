<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'order',
        'parent_id',
        'is_mobile',
        'type'
    ];

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    // Связь с дочерними пунктами меню
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
}
