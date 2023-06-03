<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');

    public static $rules = array(
        'image' => 'required',
        'body' => 'required',
    );
}
