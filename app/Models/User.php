<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'logo',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    
    
    public function likes()
    {
        return $this->belongsToMany(Trip::class,'likes','user_id','trip_id')->withTimestamps();
    }

    //この投稿に対して既にlikeしたかどうかを判別する
    public function islike($tripId)
    {
        return $this->likes()->where('trip_id',$tripId)->exists();
    }

    //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
    public function like($tripId)
    {
        $exist = $this->islike($tripId);
        
        if($exist){
            return false;
        //もし既に「いいね」していたら何もしない
        } else {
            $this->likes()->attach($tripId);
            return true;
        }
    }

    //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
    public function unlike($tripId)
    {
        $exist = $this->islike($tripId);
        
        if($exist){
        //もし既に「いいね」していたら消す
            $this->likes()->detach($tripId);
            return true;
        } else {
            return false;
        }
    }
    
    
    

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }
    
     // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
        
    }
    
    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }
    
    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }
    
    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }

}
