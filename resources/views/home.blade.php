@extends('layouts.main')

@section('header')
 <style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font: 13px Helvetica, Arial; }
  form { background: #000; padding: 3px; position: fixed; bottom: 0; width: 100%; }
  form input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
  form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
  #messages { list-style-type: none; margin: 0; padding: 0; }
  #messages li { padding: 5px 10px; }
  #messages li:nth-child(odd) { background: #eee; }
 </style>
@stop
@section('content')

 <ul id="messages"></ul>
 <form action="">
  <input id="msg" autocomplete="off" /><button>Send</button>
 </form>
@stop


@section('footer')
 <script>
  //build connection
  var conn = new WebSocket('ws://localhost:8080');
  conn.onopen = function(e) {
   console.log("Connection established!");
  };

  //send message
  $('form').submit(function(){

   var msg = $('#msg').val();
   conn.send(msg); //send message to server
   $('#msg').val('');
   return false;
  });

  //listen on port, if message comes, show it
  conn.onmessage = function(e) {
   $('#messages').append($('<li>').text(e.data));
  };
 </script>
@stop