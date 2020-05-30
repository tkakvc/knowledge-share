<?php

namespace App;
use App\User;
use App\Request_plan;
use App\Chat;
use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $primaryKey = 'knowledge_id';
    protected $table = 'knowledges'; 
    protected $fillable = ['title', 'content','user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function request_plans(){
        return $this->hasMany(Request_plan::class);
    }
}
