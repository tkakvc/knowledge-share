@extends('layouts.app')

@section('content')
    <style>
        h2{
            color:white;
            font-weight:normal;
            text-align:center;
        }
        h2 a{
            padding:0 40px;
            background:#44af35;
        }
        h3{
            color: rgba(0, 11, 11, 0.74);
            font-weight:bold;
            text-align:center;
            font-size:24px;
            margin-top: 20px;
            margin-bottom: 30px;
        }
        h3 a{
            
            color:rgba(0, 11, 11, 0.74);
        }
        
        h4{
           color:black;
            font-weight:normal;
            text-align:left;
            font-size:18px;
            margin-bottom: 20px;
        }
        .btn-secondary{
           padding:5px 160px;
           
        }
        
        .btn-secondary:hover{
            background:rgba(171, 43, 109, 0.69);
        }
        .mousikomi{
             text-align: center;
        }
        .edit{
            text-align: center;
            padding-bottom:30px;
        }
        .delete{
            text-align: center;
        }
        .request_message{
          padding:10px 150px 10px;
          margin-top:20px;
          margin-bottom:10px;  
          text-align: center;
          font-weight: bold;        
          color: rgba(0, 11, 11, 0.74);
          font-size:24px;
          border-top:solid 6px silver;
      }
      .detail-box{
          padding:10px;
          border:solid 2px lightgray;
          border-radius:4px;
          box-shadow: 3px 3px 2px gray;
          background:lightgray;
          
      }
      .plan-box{
            box-shadow: 1px 2px 2px rgba(0, 0, 0, 0.5);
            margin: 10px 0;
            padding: 10px 5px;
            border: 4px solid rgba(17, 132, 212, 0.47);
            border-radius: 6px;
            background-color: #f2f2f2;
      }
      .name{
            margin-bottom: 10px;
            color:white;
            font-size:10px;
            
        }
        .name a{
            background-color: rgba(191, 63, 129, 0.89);
            color: white;
            border:solid 4px rgba(191, 63, 129, 0.89);
            border-radius:4px;
        }
        p{
             border-left: inset 4px rgb(255, 10, 222);
             margin-top:20px;
        }
    </style>
        
       <div class="center">
           <div class="detail-box">
            
               <div class="plan-box"> 
                <h3><a>{{ $knowledge->title }}</a></h3>
                    
                <h4>{!! nl2br($knowledge->content) !!}</h4>
                <div class="name"><a>{{  $knowledge->user->name."さんのプランです"  }}</a></div>
                </div> 
                {{-- 自分以外の人のプランの場合 --}}     
                     
                         @if($user->id == $knowledge->user_id)
                     {{-- リクエストされていないプランである場合 --}}
                         @elseif ($knowledge->user_id != $user->id && is_null($request_plan))
                             {!! Form::open(['route' => ['request_plan.store']]) !!}
                                 {{Form::hidden('knowledge_id', $knowledge->knowledge_id)}}
                                 <div class="form-group">
                                    <div class="request_message">{!! Form::label('request_message','メッセージを入力し申込む' )!!}</div>
                                    <a>{!! Form::textarea('request_message',null,['class' => 'form-control']) !!}</a>
                                </div>
                                 <div class="mousikomi">{!! Form::submit('申込む', ['class' => 'btn btn-secondary']) !!}</div>
                                 
                             {!!Form::close() !!}
                         
                     {{-- リクエストしたプランのうち、承認待ちである場合 --}}
                         @elseif($request_plan->request_user_id == $user->id && $request_plan->plan_status == "pending" )
                             <p>　申込み済です</p>
                         
                     {{-- リクエストしたプランのうち、承認済みである場合 --}}
                         @elseif( $request_plan->request_user_id == $user->id && $request_plan->plan_status == "approved")
                             <p>　申込み済です</p>
                         
                         @else
                             {!! Form::open(['route' => ['request_plan.store']]) !!}
                                 {{Form::hidden('knowledge_id', $knowledge->knowledge_id)}}
                                 <div class="form-group">
                                    <div class="request_message">{!! Form::label('request_message','メッセージを入力し申込む' )!!}</div>
                                    <a>{!! Form::textarea('request_message',null,['class' => 'form-control']) !!}</a>
                                </div>
                                 <div class="mousikomi">{!! Form::submit('申込む', ['class' => 'btn btn-secondary']) !!}</div>
                             {!!Form::close() !!}
                         @endif
                    
                    
                {{-- 自分のプランの場合 編集画面へ --}}
                    
                    @if($user->id == $knowledge->user_id)
                      <p>　自分のプランです</p>
                        <div class="edit">{!! link_to_route('knowledges.edit','このプランを編集', ['knowledge_id' => $knowledge->knowledge_id], ['class' => 'btn btn-secondary']) !!}</div>
                        {!! Form::model($knowledge, ['route' => ['knowledges.destroy', $knowledge->knowledge_id], 'method' => 'delete']) !!}
                        {{--<div class="delete">{!! Form::submit('削除する', ['class' => 'btn btn-danger']) !!}</div>--}}
                        {!! Form::close() !!}
                    @endif
             
            </div>  
        </div>
        
@endsection

        