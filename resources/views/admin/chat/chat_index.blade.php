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
    <section class="content" id="app">
      <div class="row">
        <div class="col-xs-12">


            <!-- Direct Chat -->
            <div class="row">

                <!-- /.col -->
                <div class="col-md-6" style="background-color: #222d32;" >
                    <!-- Contacts are loaded here -->
                    <div class="">
                        <ul class="contacts-list">
                            @foreach($users as $user)
                                <li v-on:click="selectUser({{$user}})">
                                    <a href="#">
                                        <img class="contacts-list-img" src="https://www.shareicon.net/data/2016/05/26/771189_man_512x512.png" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                  {{$user->name}}
                                                    <small class="contacts-list-date pull-right">2/28/2018</small>
                                                </span>
                                            <span class="contacts-list-msg">You can begin chatting</span>

                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                                <!-- End Contact Item -->
                            @endforeach
                        </ul>
                        <!-- /.contatcts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->


                </div>


                <div class="col-md-6">
                    <!-- DIRECT CHAT PRIMARY -->
                    <div class="box box-primary direct-chat direct-chat-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" v-text="selectedUser.name"></h3>

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
                                <div v-for="message in messages" :class="getMsgClass(message)" >
                                    <div class="direct-chat-info clearfix">
                                        <span id="msg-user" :class="getUserNameClass(message)" cls="direct-chat-name pull-left" v-text="message.sender.name"></span>
                                        <span id="msg-time" :class="getMsgTimeClass(message)" cls="direct-chat-timestamp pull-right" v-text="message.timestamp"></span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{{ 'https://www.shareicon.net/data/2016/05/26/771189_man_512x512.png' }}}" alt="avater"><!-- /.direct-chat-img -->
                                    <div id="msg-message" class="direct-chat-text" v-text="message.message">

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
                                    @foreach($users as $user)
                                    <li v-on:click="selectUser({{json_encode($user)}})" data-widget="chat-pane-toggle">
                                        <a href="#">
                                            <img class="contacts-list-img" src="https://www.shareicon.net/data/2016/05/26/771189_man_512x512.png" alt="User Image">

                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                  {{$user->name}}
                                                  <small class="contacts-list-date pull-right">2/28/2018</small>
                                                </span>
                                            <span class="contacts-list-msg">You can begin chatting</span>

                                            </div>
                                            <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    @endforeach
                                </ul>
                                <!-- /.contatcts-list -->
                            </div>
                            <!-- /.direct-chat-pane -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                             <form name="message-form">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" id="message" name="message" placeholder="Type Message ..." class="form-control" v-model="msg">
                                <span class="input-group-btn">
                              <button id="send" class="btn btn-primary btn-flat" @click.prevent="sendMsg()">Send</button>
                            </span>
                            </div>
                             </form>
                        </div>

                        <!-- /.box-footer-->
                    </div>
                    <!--/.direct-chat -->
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
  <script>





  </script>
  <script>
       var app = new Vue({
           el: '#app',
           data: {
               selectedUserId: 0,
               selectedUser: {},
               my_id: `{{Auth::user()->id}}`,
               msg: 'test',
               messages: []
           },
           methods: {
               test (msg) {
                   this.msg=msg;
               },
               sendMsg(){
                   var id=this.selectedUserId;
                   console.log(id+','+this.selectedUserId);
                   axios.post('/admin/chat/send/'+this.selectedUserId,{message: this.msg,sender_id: this.my_id,reciever_id: this.selectedUserId }).then((response) => {
                       console.log(response);
                       var msg=response.data;
                       this.messages.push({sender:{name:'Ali',avatar:'avt'},message:msg.body,timestamp:msg.created_at,sender_id:msg.sender_id});
                   })
                   .then(function (response) {
                       console.log(response);
                   })
                   .catch(function (error) {
                       console.log(error);
                   })
                   .then(function () {
                       // always executed
                   });
               },
               getMsgClass(msg){
                   if(msg.sender_id==this.my_id) {
                       return 'direct-chat-msg right';
                   }else {
                       return 'direct-chat-msg';
                   }
               },
               getMsgTimeClass(msg){
                   if(msg.sender_id==this.my_id) {
                       return 'direct-chat-timestamp pull-left';
                   }else {
                       return 'direct-chat-timestamp pull-right';
                   }
               },
               getUserNameClass(msg){
                   if(msg.sender_id==this.my_id) {
                       return 'irect-chat-name pull-right';
                   }else {
                       return 'irect-chat-name pull-left';
                   }
               },
               loadSelectedUserMessages(){
                   axios.get('/admin/chat/messages/'+this.selectedUserId).then((response) => {
                       console.log(response.data);
                       var msgs=response.data;
                       for(i=0;i<msgs.length;i++){
                           if(msgs[i].sender_id==this.my_id){
                               var name=`{{Auth::user()->name}}`;
                               var avatar='';
                           }else{
                               var name=this.selectedUser.name;
                               var avatar='';
                           }
                           this.messages.push({sender:{name:name,avatar:avatar},message:msgs[i].body,timestamp:msgs[i].created_at,sender_id:msgs[i].sender_id});
                       }
                   });
               },
               selectUser(user){
                   this.selectedUser=user;
                   this.selectedUserId=parseInt(user.id);
                   this.messages=[];
                   this.loadSelectedUserMessages();
               }
           },
           mounted() {

               Echo.private (`App.User.{{Auth::user()->id}}`)
                   .listen('AdminPrivateMessage', (e) => {
                       var msg=e.message;
                       this.messages.push({sender:{name:'Ali',avatar:'avt'},message:msg.body,timestamp:msg.created_at,sender_id:msg.sender_id})
                   })
              .listen('AdminBroadcastMessage', (e) => {
                    //console.log(e);
                    $('#msgCount').innerText=$('#msgCount').innerText++;
              })
           }
       });
  </script>
@stop