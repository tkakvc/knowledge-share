<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Knowledge;
use App\Request_plan;
use App\Chat;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function knowledges(){
        return $this->hasMany(Knowledge::class);
    }
    
    
    public function request_plans()
    {
        return $this->belongsToMany(Knowledge::class, 'request_plans', 'request_user_id', 'knowledge_id')->withTimestamps();
    }
   
       
        }
    
    
    
    
