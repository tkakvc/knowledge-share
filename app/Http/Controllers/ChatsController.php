<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\Request_plan;
use App\Knowledge;
use App\User;

class ChatsController extends Controller
{
    //チャットメッセージ一覧
    public function getChatList($id){
        $user = \Auth::user();
        $request_plans = Request_plan::find($id);
        $knowledge = Knowledge::where('knowledge_id',$request_plans->knowledge_id)->first();
        
        if($user->id == $request_plans->request_user_id){  //ログインユーザーが依頼者である場合、プラン作成者のユーザー情報を取得
            $receiver = User::where('id',$knowledge->user_id)->first();
        }
        else{  //ログインユーザーがプラン作成者である場合、依頼者のユーザー情報を取得
            $receiver = User::where('id',$request_plans->request_user_id)->first();
        }
        
        $chats = Chat::where('status_id',$id)->get();
        $data = [
            'user' => $user,
            'request_plans' => $request_plans,
            'chats' => $chats,
            'receiver' => $receiver,
            ];
        return view('chats.index',$data);
        }
    //チャットのメッセージ送信
    public function submit(Request $request){
        $this->validate($request, [
            'message' => 'required',
        ]);
        $user = \Auth::user();
        
        $knowledge = Knowledge::where('knowledge_id',$request->knowledge_id)->first();
        //request_plansテーブルのknowledge_idとプランのID（主キー）が一致するレコードを取得 
        //さらにstatus_idで絞る。→1つのプランに対し複数のリクエストが来たときにstatus_idで区別するため
        $request_plans = Request_plan::where('knowledge_id',$request->knowledge_id)->get()->where('status_id',$request->status_id)->first();
        
        $chat = new Chat;
        $chat->submit_user_id = $user->id;
        $chat->message = $request->message;
        $chat->read_flag = "unread";
        $chat->status_id = $request_plans->status_id;
        
        if(//ログインユーザー＝依頼者 のとき メッセージの受信者はプラン作成者
        $user->id == $request_plans->request_user_id){
            $chat->receive_user_id = $knowledge->user_id;
        }else{//ログインユーザー＝プラン作成者 のとき メッセージの受信者は依頼者
            $chat->receive_user_id = $request_plans->request_user_id;
        }
        $chat->save();
        return back();
        }
    }
   