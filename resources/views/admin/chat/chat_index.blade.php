{{! $menu="chat" }}
{{! $mode="index" }}

@extends('adminlte::page')

@section('title', ucfirst($menu) )

@section('content_header')
    <h1 class="hidden-sm hidden-xs">
        {{ ucfirst($menu) }} <small>{{ ucfirst($mode) }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route($menu) }}">{{ ucfirst($menu) }}</a></li>
        <li class="active">{{ ucfirst($mode) }}</li>
    </ol>
@stop
@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">



            <!-- Direct Chat -->
            <div class="row">
                <div class="col-md-6">
                    <!-- DIRECT CHAT PRIMARY -->
                    <div class="box box-primary direct-chat direct-chat-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Direct Chat</h3>

                            <div class="box-tools pull-right">
                                <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                                    <i class="fa fa-comments"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <input type="hidden" id="username" value="{{ isset(Laratrust::user()->name)?Laratrust::user()->name:'Guest' }}">
                            <!-- Conversations are loaded here -->
                            <div id="messages" class="direct-chat-messages">
                                <!-- Message. Default to the left -->
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span id="msg-user" class="direct-chat-name pull-left" >System</span>
                                        <span id="msg-time" class="direct-chat-timestamp pull-right" >23 Jan 2:00 pm</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{{ 'https://www.shareicon.net/data/2016/05/26/771189_man_512x512.png' }}}" alt="avater"><!-- /.direct-chat-img -->
                                    <div id="msg-message" class="direct-chat-text">
                                        You can begin Negotiation. Goodluck!
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                                <!-- /.direct-chat-msg -->

                                <!-- Message to the right -->

                                <!-- /.direct-chat-msg -->
                            </div>
                            <!--/.direct-chat-messages-->

                            <!-- Contacts are loaded here -->
                            <div class="direct-chat-contacts">
                                <ul class="contacts-list">
                                    <li>
                                        <a href="#">
                                            <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Image">

                                            <div class="contacts-list-info">
                                  <span class="contacts-list-name">
                                    Count Dracula
                                    <small class="contacts-list-date pull-right">2/28/2018</small>
                                  </span>
                                                <span class="contacts-list-msg">You can begin chatting</span>

                                            </div>
                                            <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                </ul>
                                <!-- /.contatcts-list -->
                            </div>
                            <!-- /.direct-chat-pane -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            {{-- <form name="message-form">
                            {{ csrf_field() }} --}}
                            <div class="input-group">
                                <input type="text" id="message" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-btn">
                              <button id="send" class="btn btn-primary btn-flat">Send</button>
                            </span>
                            </div>
                            {{-- </form> --}}
                        </div>

                        <!-- /.box-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>
                <!-- /.col -->
                <div class="col-md-6" style="background-color: blue" id="cont">
                    <video  id="vid" name="vid" height="200px" width="200px" autoplay></video>
                    <style>
                        video {
                            -webkit-filter: blur(4px) invert(1) opacity(0.5);
                        }
                    </style>
                </div>
            </div>
            <!-- /.row Direct chat-->


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    {{--  --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">


@stop

@section('js')
  <script> console.log('Hi!'); </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.dev.js" type="text/javascript"></script>
  <script>
      Echo.private (`App.User.{{Auth::user()->id}}`)
          .listen('AdminPrivateMessage', (e) => {
              console.log(e.message);
              let msgitem=`
                      <!-- Message. Default to the left -->
                      <div class="direct-chat-msg">
                          <div class="direct-chat-info clearfix">
                              <span id="msg-user" class="direct-chat-name pull-left" >User-123</span>
                              <span id="msg-time" class="direct-chat-timestamp pull-right" >23 Jan 2:00 pm</span>
                          </div>
                          <!-- /.direct-chat-info -->
                          <img class="direct-chat-img" src="{{{ 'https://www.shareicon.net/data/2016/05/26/771189_man_512x512.png' }}}" alt="avater"><!-- /.direct-chat-img -->
                          <div id="msg-message" class="direct-chat-text">
                              `+e.message.message+`
                          </div>
                          <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->`;

              $("#messages").append(msgitem);
      })
      .listen('AdminBroadcastMessage', (e) => {
            console.log(e);
            $('#msgCount').innerText=$('#msgCount').innerText++;
      });



  </script>
@stop