@extends('layouts.app')

@section('content')
    
    <h1>マイページ</h1>
    <h2>{!! link_to_route('mypage','マイプラン') !!}</h2>
    @foreach ($request_plans as $request_plan)
    
    <div class="plan"> 
    
    <h3>{!! link_to_route('knowledges.show', $request_plan->title, ['id' => $request_plan->id]) !!}</h3>
    @if($request_plan->plan_status == "pending")
        <p>{{ $request_plan->name }}さんから申し込みが来ています！</p>
        {!! Form::open(['route' => ['request_plan.receive']]) !!}
            {{Form::hidden('status_id', $request_plan->status_id)}}
            {!! Form::submit('承認する', ['class' => "btn btn-secondary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
    @if($request_plan->plan_status == 'approved')
        {!! link_to_route('chat.index', "メッセージ画面へ進む",['id' => $request_plan->status_id]) !!}
    @endif
    
    @endforeach
    </div>
    
    <h2>{!! link_to_route('requestplan','リクエストしたプラン') !!}</h2>    

@endsection
    
    
    
   