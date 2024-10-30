<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExecutorProfile extends Model
{
    use HasFactory;

    protected $table = "executor_profiles";

    protected $fillable = ['user_id', 'name', 'last_name', 'job_title', 'direction'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
