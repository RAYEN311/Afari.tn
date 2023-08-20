<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class afari_users extends Model
{
    use HasFactory;

    protected $Table = 'afari_users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password'
    ] ; 

}
