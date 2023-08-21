<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use laravel\sanctum\NewAccessToken ;


class users extends Model
{
    use HasFactory;

    protected $Table = 'users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password'
    ] ; 

}
