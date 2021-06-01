<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chat</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
    <body>
        <div id='root'></div>
        <script src="{{asset('js/chat.js')}}"></script>
    </body>
</html>
