<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ナレッジシェア</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Paytone+One&display=swap" rel="stylesheet">
    <link href="https://fontawesome.com/icons/bolt?style=solid" rel="stylesheet">
    <style>
        body{
            background:rgba(189, 191, 63, 0.02);
            font-family:'メイリオ',
            'Hiragino Kaku Gothic Pro', sans-serif
        }
    </style>
    </head>
    
    <body>
    
        @include('layouts.header')
        
        <div class="container">
            @include('layouts.error_messages')
            
            @yield('content')
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script type="text/javascript">
        $(function() {
          $(".tab a").click(function() {
            $(this).parent().parent().addClass("active").siblings(".active").removeClass("active");
            var tabContents = $(this).attr("href");
            $(tabContents).addClass("active").siblings(".active").removeClass("active");
            return false;
          });
        });
        </script>
    </body>
</html>