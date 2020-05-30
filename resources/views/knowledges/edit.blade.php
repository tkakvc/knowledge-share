@extends('layouts.app')

@section('content')
    <style>
        h2 {
            color:gray;
            font-weight:bold;
            text-align:center;
        }
        p{
            color:rgba(103, 105, 98, 0.9);
            margin:0;
            text-align:center;
            
            
        }
        .toukou{
             text-align:center;
        }
        
        .center{
            width:1000px;
        }
        
        .btn-secondary {
             padding: 10px 100px;
            
        }
        .form-group p{
            border-left:solid 6px #3c9b2f;
        }
    </style>
    <div class="row">    
        
        <div class="left"></div>    
    
        <div class="center">
            @if (count($errors) > 0)
                <ul class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <li class="ml-4">{{ $error }}</li>
            @endforeach
                </ul>
            @endif
            
            <div class="form-horizontal">
            <h2>プラン編集</h2>
                <div class="row">
                    <div class="col-12">
                        {!! Form::model($knowledge, ['route' => ['knowledges.update',$knowledge->knowledge_id],'method' => 'put']) !!}
                            <div class="form-group">
                                {!! Form::label('title', 'タイトル') !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('content','プランの内容' )!!}
                                {!! Form::textarea('content',null,['class' => 'form-control']) !!}
                            </div>
                            <div class="toukou">{!! Form::submit('更新', ['class' => 'btn btn-secondary']) !!}</div>
                            
                        {!! Form::close() !!}
                    </div>
                </div>
        
            </div>
        </div>
        <div class="right"></div>
    
    </div>
@endsection