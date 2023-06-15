<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');

    public static $rules = array(
        'user_id',
        'image' => 'required',
        'body' => 'required',
        'map'
    );
    
    protected $fillable = ['user_id','image','body','map'];

    //1対多のリレーション追加
    public function user() {
        return $this->belongsTo(User::class);
    }
}
