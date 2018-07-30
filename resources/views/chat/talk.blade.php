{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>直接聊天</h1>

@stop

@section('content')
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-12">


                <div class="box box-success direct-chat direct-chat-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">直接聊天</h3>

                        <div class="box-tools pull-right">
                            <span data-toggle="tooltip" title="" class="badge bg-green" data-original-title="3 New Messages">3</span>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                                <i class="fa fa-comments"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages">
                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg" v-for="msg in messages"  v-if="msg.fromUid !='a_1'" >
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">@{{ msg.fromUid }}</span>
                                    <span class="direct-chat-timestamp pull-right">@{{ msg.createTime }}</span>
                                </div>
                                <!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="/vendor/adminlte/dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    @{{ msg.content }}
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                            <!-- Message to the right -->
                            <div class="direct-chat-msg right"  v-for="msg in messages"  v-if="msg.fromUid==='a_1'">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">@{{ msg.fromUid }}</span>
                                    <span class="direct-chat-timestamp pull-left">@{{ msg.createTime }}</span>
                                </div>
                                <!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="/vendor/adminlte/dist/img/user3-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    @{{ msg.content }}
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->
                        </div>
                        <!--/.direct-chat-messages-->

                        <!-- Contacts are loaded here -->
                        <div class="direct-chat-contacts">
                            <ul class="contacts-list">
                                <li>
                                    <a href="#">
                                        <img class="contacts-list-img" src="/vendor/adminlte/dist/img/user1-128x128.jpg" alt="User Image">

                                        <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Count Dracula
                              <small class="contacts-list-date pull-right">2/28/2015</small>
                            </span>
                                            <span class="contacts-list-msg">How have you been? I was...</span>
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
                        <form action="#" method="post">
                            <div class="input-group">
                                <input type="text" id="message" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-btn">
                        <button type="button" id="sendBtn" class="btn btn-success btn-flat">发送</button>
                      </span>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-footer-->
                </div>



            </div>
            <!-- /. box -->

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/libs/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <style type="text/css">

        .direct-chat-messages{
            height: 500px;
        }
    </style>


@stop

@section('js')
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/libs/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

    <script src="/assets/deps/bundle.js"></script>

    <script src="/libs/protobuf.js-6.8.6/dist/protobuf.min.js"></script>

    <script src="/libs/template-web.js"></script>


    <script src="/js/gchat.js"></script>


    <script src="/libs/socket.io.js"></script>
    <script src="/libs/moment-with-locales.js"></script>


    <script>



        var  kMsgList = [];

        Vue.prototype.messages = kMsgList;

        //
        // var app = new Vue({
        //     el: '#app',
        //
        //     data: {
        //         messages:kMsgList,
        //
        //     }
        // })



        console.log(app.data);
        $(function () {
            //Add text editor
            //$('#compose-textarea').wysihtml5()


            $("#sendBtn").click(function (event) {


                var content = $("#message").val();

                GChatClient.talk("",0,"a_1",content);

                app.messages.push({content:content,fromUid:"a_1"})


                event.preventDefault();
            })




        })
    </script>
@stop