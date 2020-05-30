<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Knowledge; 
use App\User;
use App\Request_plan;
use App\Chat;

class KnowledgesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * プラン一覧表示
     * 
     * @return \Illuminate\Http\Response
     */
     
    public function index()
    {
        $knowledges = Knowledge::get();
        
        return view('knowledges.index', [
            'knowledges' => $knowledges,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * プラン新規作成画面
     * 
     * @return \Illuminate\Http\Response
     */
     
    public function create()
    {
        $knowledge = new Knowledge;
        
        return view('knowledges.create',[
            'knowledge' => $knowledge]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * プラン新規作成
     * 
     * @return \Illuminate\Http\Response
     */
     
    public function store(Request $request)
    {
         
         $this->validate($request, [
            'content' => 'required',
        ]);
        $user = \Auth::user();
        $knowledge = new Knowledge;
        $knowledge->user_id = $user->id;
        $knowledge->user_name = $user->name;
        $knowledge->title = $request->title;
        $knowledge->content = $request->content;
        $knowledge->save();

        return redirect('/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     * プランの詳細画面
     * 
     * @return \Illuminate\Http\Response
     */
     
    public function show($knowledge_id)
    {
        $user = \Auth::user();
        $knowledge = Knowledge::where('knowledge_id',$knowledge_id)->first();
        $request_plan = Request_plan::where('knowledge_id',$knowledge_id)->first();
        return view('knowledges.show', [
            'knowledge' => $knowledge,
            'request_plan' => $request_plan,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * 
     * プラン編集画面
     * 
     * @return \Illuminate\Http\Response
     */
    
    public function edit($knowledge_id)
    {
        
        $knowledge = Knowledge::where('knowledge_id',$knowledge_id)->first();
        return view('knowledges.edit',[
            'knowledge' => $knowledge,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     * プランを編集（更新）する
     * 
     * @return \Illuminate\Http\Response
     */
     
    public function update(Request $request, $knowledge_id)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);
        
        $knowledge = Knowledge::where('knowledge_id',$knowledge_id)->first();
        $knowledge->content = $request->content;
        $knowledge->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     * プランを削除する
     * 
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $knowledge = Knowledge::find($id);
        $knowledge->delete();

        return redirect('/');
    }
    
    //マイページを表示する
    public function mypage(){
         $data = [];
         if (\Auth::check()) {
            $user = \Auth::user();
              
            // マイプラン一覧取得
            $knowledges = Knowledge::where('user_id',$user->id)->get();
            // マイプラン一覧のうちリクエストが来たプランを取得
            $myplans_requested = Request_plan::where('plan_status','approved')->orWhere('plan_status','pending')
                ->join('knowledges','knowledges.knowledge_id','=','request_plans.knowledge_id')->join('users','users.id','=','request_plans.request_user_id')
                ->get();
            // リクエストプラン一覧取得
            $request_plans = Request_plan::where('request_user_id',$user->id)
                ->join('knowledges','knowledges.knowledge_id','=','request_plans.knowledge_id')
                ->get();
            
            $data = [
                'user' => $user,
                'knowledges' => $knowledges,
                'request_plans' => $request_plans,
                'myplans_requested' => $myplans_requested,
                
            ];
         }
        
         return view('knowledges.mypage', $data);
     }
     
}

