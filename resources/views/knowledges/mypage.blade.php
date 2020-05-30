@extends('layouts.app')

@section('content')
    <style>
      .box{
            margin: 1em 0;
            padding:10px;
            background: white;
            border:dotted 2px gray;
            box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.13);
            
      }
      .plan{
          box-shadow: 1px 2px 2px rgba(0, 0, 0, 0.5);
          margin: 10px 0;
          padding: 10px 5px;
          border: 2px solid lightgray;
          border-radius:6px;
          background-color: #f2f2f2;
      }
      .plan p{
          text-align: center;
          font-size:14px;
      }
     ul{
        margin:0;
        padding:0;
        list-style:none;
        
      }
      li a{
        display:block;
        color:black;
        font-size:14px;
        text-decoration:none;
        padding: 16px ;
        
      }
      
      ul:after{
        content:"";
        display:block;
        clear:both;
      }
      li{
        float:left;
        width:50%;
        
      }
      li:hover{
          text-decoration:none;
      }
      li a{
          text-align: center;
      }
      .tab2 {
          background:white;
          
          
      }
      .tab2 a{
          color: rgba(191, 63, 129, 0.7);
          text-decoration:underline;
          font-size:16px;
          font-weight: bold;
      }
      .tab2 a:hover{
          color:gray;
          text-decoration:none;
          font-size:17px;
          text-decoration:underline;
      }
      
      li.active div a{
          color: gray;
          font-size:24px;
          font-weight:bold;
          text-decoration: underline;
          text-decoration-color:gray;
          background-color: lightgray;
          
      }
      li.active div a:hover{
          font-size:24px;
      }
      
      .tabContents{
          padding:20px;
          background:lightgray;
          
      }
      .tab1 a{
          color: rgba(191, 63, 129, 0.7);
          text-decoration:underline;
          font-size:16px;
          font-weight: bold;
      }
      .tab1 a:hover{
          color:gray;
          text-decoration:none;
          font-size:17px;
          text-decoration:underline;
      }
      
      
      .message a{
          text-decoration: none;
          color:gray; 
          background:white;
          border-top: 3px solid white;
          border-bottom: 3px solid white;
          border-radius: 6px;
          padding: 4px 70px;
          font-size: 18px;
          }
      .message a:hover{
          font-size:19px;
         }
      .request {
          text-decoration: none;
          color:#44af35;
         }
      h3 {
            text-align:center;
            margin-bottom: 0;
            
        }
      h3 a{
            color:white;
            background:gray;
            font-weight:normal;
            text-align:center;
            font-size:20px;
            padding:0 17px;
            border:solid 3px gray;
            border-radius: 4px;
                        
      }
      h3 a:hover{
            color:lightgray;
            text-decoration:none;
        }
      button.btn{
         padding:5px 80px;
         
      }
      .approve{
        text-align:center;
        margin-bottom:20px;
      }
      .request{
        text-align:center;
        font-weight:bold;
        color:black;
        padding-bottom:5px;
        font-size:20px;
      }
      .message{
        text-align:center;
        text-decoration:underline;
        font-size:18px;
        margin-bottom: 30px;
        
      }
      .pending{
         margin-left:42%;
         border-left: inset 8px rgb(255, 10, 222);
          
      }
      .pending p{
         margin-top:20px;
         margin-left: 26px;
         text-align:left;
         
      }
      .approved{
         margin-left:42%;
         border-left: inset 8px rgb(255, 10, 222);
         
      }
      .approved p{
         margin-top:20px;
         margin-left: 26px;
         text-align:left;
      }
      .message-box{
          border:solid 2px lightgray;
          border-radius:2px;
          padding:10px 30px;
          margin:20px 130px;
          
      }
      .request-message{
          padding:0 6px;
          margin:3px 0;
          background:#ecf7ea;
          background:#f1f1f1;
          margin-bottom: 0;
          font-weight: bold;
          color:gray;
          
          
      }
      .message-content{
          padding:0 6px;
          margin:6px 0 ;
          background:#ecf7ea;
          background:white;
          color:gray;
          margin-top:0;
          
      }
      .name{
         margin-left:36%;
         border-left: inset 8px rgb(255, 10, 222);
      }
      .name p{
          margin-left: 30px;
          text-align:left;
      }
      h2{
          font-weight:bold;
          color:gray;
      }
      .btn-secondary{
          background-color: rgba(191, 73, 169, 1);
          border:solid 1px rgba(191, 73, 169, 1);
      }
      .btn-secondary:hover{
          background-color: rgba(191, 63, 129, 0.7);
          border:solid 1px rgba(191, 63, 129, 0.7);
      }
      
      
    </style>
    
    
    <h2>マイページ</h2>
    <div class="box">
        <ul class="tab">
          <li class="active"><div class="tab1"><a href="#tab1" >　　マイプラン　　</a></div></li>
          <li><div class="tab2"><a href="#tab2">　リクエストしたプラン　</a></div></li>
        </ul>
        
        
        {{-- 自分のプランの一覧を表示する --}}
        
        <div class="tabContents active" id="tab1">
         
            @foreach ($knowledges as $knowledge)
            
            <div class="plan"> 
            
            <h3>{!! link_to_route('knowledges.show', $knowledge->title, ['id' => $knowledge->knowledge_id]) !!}</h3>
            　
              @foreach  ($myplans_requested as $myplan_requested)
                
                {{--  リクエストを受けまだ承認していないプランに『承認する』ボタンを表示 --}}
                @if($myplan_requested->plan_status == "pending" && $myplan_requested->knowledge_id == $knowledge->knowledge_id)
                    <div class="request"><a>{{  $myplan_requested->name."さんから申し込みが来ています！"}}</a></div>
                    {!! Form::open(['route' => ['request_plan.receive']]) !!}
                        {{Form::hidden('status_id', $myplan_requested->status_id)}}
                            <div class="message-box">    
                                <div class="request-message">リクエストメッセージ</div>
                                <div class="message-content">{{ $myplan_requested->request_message }}</div>
                            </div>
                            <div class="approve"><button type="submit" class="btn btn-secondary" >承認する</button></div>
                            
                    {!! Form::close() !!}
                @endif
                {{--  リクエストされて既に承認したプランに『メッセージ画面へ進む』表示 --}}
                @if($myplan_requested->plan_status == 'approved' && $myplan_requested->knowledge_id == $knowledge->knowledge_id)
                    <div class="name"><p>{{$myplan_requested->name."さんからのリクエスト"}}</p></div>
                    <div class="message">{!! link_to_route('chat.index', "➡メッセージ画面へ進む",['id' => $myplan_requested->status_id]) !!}</div>
                @endif
                
                @if($myplan_requested->plan_status != "pending" && $myplan_requested->plan_status != "approved" && $myplan_requested->knowledge_id == $knowledge->knowledge_id)
                <p>まだリクエストは来ていません</p>
                @endif
              
              @endforeach
            </div>
            @endforeach
         </div>
        
        
        {{-- リクエストしたプランの一覧を表示 --}}
        
        <div class="tabContents" id="tab2">
            @foreach ($request_plans as $request_plan)
                               
                <div class="plan"> 
                
                <h3>{!! link_to_route('knowledges.show', $request_plan->title, ['id' => $request_plan->knowledge_id]) !!}</h3>
                    @if($request_plan->plan_status == "approved")
                        <div class="approved"><p>承認済みです</p></div>
                        <div class="message">{!! link_to_route('chat.index', "➡メッセージ画面へ進む", ['id' => $request_plan->status_id]) !!}</div>
                    @else
                        <div class="pending"><p>承認待ちです</div>
                    @endif
                
                </div>
                
            @endforeach
        </div>
    </div>
    
@endsection

