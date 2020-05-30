
@extends('layouts.app')

@section('content')

    <!-- 自分やユーザーの情報 -->
    
<style>
    .box{
        height: 100%;
        font-family: "Hiragino Kaku Gothic ProN","メイリオ", sans-serif;
        font-size: 16px;
        line-height: 1.8;
        color:black;
        margin-bottom:14px;
    }
    .card-header{
        background-color:rgba(0, 0, 60, 0.8);
        background-color: rgba(171, 53, 109, 0.82);
        color:white;
        font-weight:bold;
        font-size:24px;
    }
    .card-body{
        background-color:rgba(101, 23, 49, 0.04);
    }
    
.send {
  margin: 10px 0;
}
.recieve{
    margin: 10px 0;
}
.send p{
     display: inline-block;
      position: relative; 
      margin: 0 10px 0 0;
      padding: 8px 16px;
      max-width: 80%;
      border-radius: 8px;
      font-size: 15px;
     background: rgba(0, 11, 11, 0.44);;
     filter: drop-shadow(6px 6px 6px rgba(0,0,0,0.3));
     color: rgba(241, 242, 242, 1);
     
    }
.recieve p {
     display: inline-block;
      position: relative; 
      margin: 0 10px 0 0;
      padding: 8px 16px;
      max-width: 80%;
      border-radius: 8px;
      font-size: 15px;
     background-color:lightgray ;
     filter: drop-shadow(6px 6px 6px rgba(0,0,0,0.5));
    }
.send :after {
  content: "";
  position: absolute;
  top: 6px; 
  right: -24px;
  border: 6px solid transparent;
  
  border-left: 18px solid rgba(0, 11, 11, 0.44);
  
  
}

.recieve p:after {
  content: "";
  display: inline-block;
  position: absolute;
  top: 6px; 
  left: -24px;
  border: 6px solid transparent;
  border-right: 18px solid lightgray;
  
}
.btn-secondary{
    background:rgba(191, 63, 129, 0.82);
}
    
</style>
    
   
            
             

            <!-- タイムライン部分③ -->
            <div id="bms_messages">

                <!--メッセージ１（左側）-->
            <div class="box">
               <section class="card">
                   {{-- 相手のユーザー名 --}}
                   <div class="card-header">{{$receiver->name}}</div>
                   
                   {{-- チャットの一覧 --}}
                   <div class="card-body">
                        @foreach($chats as $chat)
                            
                            {{--   送信したメッセージ  --}}
                            @if($chat->submit_user_id == $user->id)
                                <div class="send" style="text-align: right" >
                                    <p>{{$chat->message}}</p>
                                </div>
                 
                            @endif
             
                            {{--   受信したメッセージ  --}}
                            @if($chat->receive_user_id == $user->id)
                                <div class="recieve" style="text-align: left" >
                                    <p>{{$chat->message}}</p>
                                </div>
                            @endif
                        @endforeach
                   </div>
                </section>
            </div>
              
              
              {{--  メッセージ送信フォーム --}}
              <section>
                
                {!! Form::model($chats, ['route' => 'chat.submit']) !!}
                  <div class="input-group" style="margin-bottom:100px">
                    {!! Form::text('message','', ['class' => 'form-control']) !!}
                    <span class="input-group-btn"><button class="btn btn-secondary" type="button">
                        {{Form::hidden('knowledge_id', $request_plans->knowledge_id)}}
                        {{Form::hidden('status_id', $request_plans->status_id)}}送信</button></span>
                  </div>
                {!! Form::close() !!}
              
              </section>
            
           
        
  

@endsection