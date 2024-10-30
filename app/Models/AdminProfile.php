<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{

    protected $fillable = ['rights', 'job_title'];

    use HasFactory;
}
