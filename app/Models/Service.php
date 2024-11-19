<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    /*
     CREATE TABLE services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    value DECIMAL(10, 2) NOT NULL,
    fee DECIMAL(10, 2) NOT NULL,
    countable BOOLEAN NOT NULL DEFAULT TRUE
);
       */
    protected $fillable = ['title', 'description', 'value', 'fee', 'countable'];

}
