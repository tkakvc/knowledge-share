<?php

namespace App;
use App\Knowledge;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Request_plan extends Model
{
    protected $table = 'request_plans';
    protected $fillable = ['request_user_id','plan_id','plan_stauts'];
    public function users (){
        return $this->belongsTo(User::class);
    }
    public function knowledges(){
        return $this->belongsTo(Knowledge::class);
    }
}
