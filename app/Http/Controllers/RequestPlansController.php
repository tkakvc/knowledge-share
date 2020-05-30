<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Knowledge; 
use App\User;
use App\Request_plan;
use App\Chat;
use Illuminate\Support\Facades\DB;
class RequestPlansController extends Controller
{
    //リクエストを送る（プランに申込む）
    public function store(Request $request)
    {
        $this->validate($request, [
            'request_message' => 'required',
        ]);
        $user = \Auth::user();
        $knowledge = Knowledge::where('knowledge_id',$request->knowledge_id)->first();
        
        $request_management = [
        'request_user_id' => $user->id,
        'knowledge_id' => $knowledge->knowledge_id,
        'plan_status' => "pending",
        'request_message' => $request->request_message,
        ];
        DB::table('request_plans')->insert($request_management);
        
        return redirect('/');
    }
    
    //リクエスト承認する
    public function receive(Request $request)
    {
        $user = \Auth::user();
        $request_plans = Request_plan::find($request->status_id);
        $request_plans->plan_status = "approved";
        $request_plans->save();
        return redirect('/'); 
    }
}
