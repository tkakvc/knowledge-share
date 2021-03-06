<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Knowledge;
use App\Request_plan;
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
    // public function request_plan($knowledgeId)
    // {
    //     // 既に申し込みしているかの確認
    //     $exist_request_plan = $this->is_request_plan($knowledgeId);
    
    //     if ($exist_request_plan ) {
    //         // 既に申し込みしていれば何もしない
    //         return false;
    //     } else {
    //         // 申し込みしていなければ申し込む
    //         $this->request_plans()->attach($knowledgeId);
    //         return true;
    //     }
    // }
        public function is_request_plan($knowledgeId)
        {
            return $this->request_plans()->where('knowledge_id', $knowledgeId)->exists();
        }
        public function feed_request_plans()
        {
        $my_request_plan_ids = $this->request_plan()->pluck('request_plans.id')->toArray();
        $my_request_plan_ids[] = $this->id;
        return Knowledge::whereIn('knowledge_id', $my_request_plan_ids);
        }
    
    
    
    
}
