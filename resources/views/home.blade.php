@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>You are logged in!</p>
    vue?
    <example-component></example-component>
@stop

@section('js')
    <script> console.log('Hello world!'); </script>

    <script>
        {{----}}
        console.log('entered');
        window.app = new Vue({
            el: '#app',
            data: {
                msg: 'hello'
            },
            created(){
                console.log('vue created');
                Echo.private('message-channel')
                    .listen('Message', (e) => {
                    alert("private message event trigged", e);
                console.log(e);
            });
                //Echo.channel('broadcast-channel')
                // .listen('Message', (e) => {
                //     alert("broadcast channel message event trigged", e);
                //     console.log(e);
                // });
            }
        });
    </script>
@stop