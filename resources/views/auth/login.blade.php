@extends('layouts.app')

@section('content')
<style>
h2{
    color:rgba(73, 65, 98, 0.8);
    text-align:center;
    margin-top:80px;
    font-size:40px;
}
.mt-2 a{
  color:gray; 
}
</style>
    
        <main>
            <div class="left"></div>
            <div class="center">
            
            
        <h2>ログイン</h2>
    
        <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Log in', ['class' => 'btn btn-secondary btn-block']) !!}
            {!! Form::close() !!}

            <div class="mt-2">New user? <div class="new">{!! link_to_route('signup.get', 'Sign up now!') !!}</div></div>
        </div>
    </div>
    
    </div>
            <div class="right"></div>
        </main>
        
        
    </body>
@endsection