<header>
    <style>
      .header-left h1 a{
        color:rgba(0, 11, 11, 0.74);
        text-decoration:none;
        font-weight: bold;
        
      }
      h1{
        background:white;
        margin-bottom: 0;
      }
      .navbar ul{
        margin:0;
        padding:0;
        list-style:none;
        
      }
      .navbar li a{
        display:block;
        
        color:white;
        font-size:14px;
        text-decoration:none;
        padding: 10px ;
        
      }
      
      .navbar ul:after{
        content:"";
        display:block;
        clear:both;
      }
      .navbar li{
        float:left;
        width:auto;
        
      }
      .navbar{
        background-color:rgba(0, 11, 11, 0.44);
        margin-bottom:10px;
        padding:0;
        
      }
      .navbar li a:hover{
        background-color:silver;
      }
      .navbar{
      
      }
    </style>
    <style>
      /*mypage用のCSS*/
      .tabContents {
        display: none;
      }
      .tabContents.active {
        display: block;
      }
    </style>
    <div class="header-left">
      <h1><a>{!! link_to_route('knowledges.index','ナレッジシェア') !!}</a></h1>
    </div>
    <div class="navbar">
      @if (Auth::check())
      <ul>
          <li>{!! link_to_route('knowledges.index','トップ') !!}</li>
          <li> {!! link_to_route('knowledges.create', 'プラン作成') !!}</li>
          <li> {!! link_to_route('mypage', 'マイページ') !!}</li>
          <li> {!! link_to_route('logout.get', 'ログアウト') !!}</li>
        
      </ul> 
      @else
      <ul>
          <li>{!! link_to_route('login', 'ログイン') !!} </li>
          <li>{!! link_to_route('signup.get', '新規登録') !!}</li>
      </ul>
      @endif
    </div>
</header>