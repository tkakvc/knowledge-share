@extends('layouts.app')

@section('content')
    <style>
        h2 {
            color:gray;
            font-weight:bold;
            text-align:center;
        }
        p{
            color:gray;
            margin:0;
            text-align:center;
            
        }
        .toukou{
             text-align:center;
        }
        
        .center{
            width:1000px;
        }
        
        .btn {
             padding: 10px 100px;
            
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
                
                <div class="col-md-12">
                    <h2>プラン新規作成ページ</h2>
                    {!! Form::model($knowledge, ['route' => 'knowledges.store']) !!}
                    
                        <div class="form-group">
                            <p>{!! Form::label('title', 'タイトル') !!}</p>
                            <a>{!! Form::text('title', null, ['class' => 'form-control']) !!}</a>
                        </div>
                        <div class="form-group">
                            <p>{!! Form::label('content','プランの内容' )!!}<p>
                            <a>{!! Form::textarea('content',null,['class' => 'form-control']) !!}</a>
                        </div>
                    
                        <div class="toukou">{!! Form::submit('投稿', ['class' => 'btn btn-secondary']) !!}</div>
    
                    {!! Form::close() !!}
                </div>
                
            </div>
    
        </div>

        <div class="right"></div>
    
    </div>
@endsection
        