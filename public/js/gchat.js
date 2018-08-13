var Buffer = require('buffer').Buffer;

  function blob2buffer (blob,cb)
{

    if (typeof Blob === 'undefined' || !(blob instanceof Blob)) {
        throw new Error('first argument must be a Blob')
    }
    if (typeof cb !== 'function') {
        throw new Error('second argument must be a function')
    }

    var reader = new FileReader()

    function onLoadEnd (e) {
        reader.removeEventListener('loadend', onLoadEnd, false)
        if (e.error) cb(e.error)
        else cb(null, Buffer.from(reader.result))
    }

    reader.addEventListener('loadend', onLoadEnd, false)
    reader.readAsArrayBuffer(blob)

};

var GChatClient = {

    isProtoLoad: false,
    isConnected: false,
    protocol: null,

    myid: "arthur",

    connTimer: null,
    //host: "ws://10.246.60.58:6767",
    host: "ws://127.0.0.1:49009",
    websock: null,

    common_proto:null,


    load_common_proto:function()
    {
        var self = this;

        protobuf.load("/libs/chatproto/common.proto", function (err, root) {
            if (err) {
                throw err;
            }
            self.common_proto = root;

            console.log("load common protobuf success");


        });
    },

    load_proto: function () {
        var self = this;

        protobuf.load("/libs/chatproto/client.proto", function (err, root) {
            if (err) {
                throw err;
            }
            self.protocol = root;

            console.log("load protobuf success");
            window.setInterval(function () {
                self.connect();
            },3000)

        });

    },

        connect:function () {
            var self = this;
            if (this.isConnected)
            {
                console.log("is connected");
                return ;
            }


            if ("WebSocket" in window) {

                this.websock = new WebSocket(this.host);


                this.websock.onopen = function(event) {


                    console.log("websocket is connected")
                    self.isConnected = true;

                    self.login();

                };

                this.websock.onmessage = function (evt) {
                    var received_msg = evt.data;
                    console.log("Message is received...");

                    console.log(evt.data);



                    blob2buffer(evt.data,function (err,buffer) {


                        var length = buffer.readInt16LE();
                        var cmdid = buffer.readInt16LE(2);

                        console.log("command id is "+cmdid);

                        var pbuf = buffer.slice(4);

                        if (cmdid == 3)
                        {
                            self.on_login(pbuf);
                        }else if (cmdid == 10)
                        {
                            //self.on_talk(pbuf);
                            self.on_msg_list(pbuf);
                        }else if (cmdid== 9)
                        {
                            self.on_msg_info(pbuf);
                        }
                    })


                };

                this.websock.onclose = function() {

                    // websocket is closed.
                    console.log("Connection is closed...");

                    self.isConnected = false;
                };

            } else {

                // The browser doesn't support WebSocket
                console.log("WebSocket NOT supported by your Browser!");
            }

        },

        on_login(pbuf){

           var self = this;

            var LoginRsp = self.protocol.lookupType("chat.client.LoginRsp");
            try {
                var loginRsp = LoginRsp.decode(pbuf);
                console.log(loginRsp);

            } catch (e) {

                console.log(e);

            }

        },

        ping:function() {
            if(!self.isConnected)
                return;
            var msgHead = new Buffer(4);
            msgHead.writeInt16LE(2, 0);
            var cmdId = 101;
            msgHead.writeInt16LE(cmdId, 2);

            var  pingMsg = Buffer.concat([msgHead],msgHead.length);
            this.websock.send(pingMsg);
        },

        login:function(){


            var LoginReq = this.protocol.lookupType("chat.client.LoginReq");

            var payload = {
                appid:"123456",
                token:"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBpZCI6IjEyMzQ1NiIsInVpZCI6ImFydGh1ciJ9.NMxMZg6q5hbh9nwp1Ui1l690OwOsj4QslWpEX1-cNFI",
                uid: this.myid
            };

            var errMsg = LoginReq.verify(payload);
            if (errMsg)
            {
                throw Error(errMsg);
            }

            var msgHead = new Buffer(4);
            var loginReq = LoginReq.create(payload);


            var buffer = LoginReq.encode(loginReq).finish();
            console.log(buffer);

            msgHead.writeInt16LE(buffer.length + 2, 0);
            var cmdId = 2;
            msgHead.writeInt16LE(cmdId, 2);

            var message = LoginReq.decode(buffer);
            var loginObj = LoginReq.toObject(message, {
                longs: String,
                enums: String,
                bytes: String,
                // see ConversionOptions
            });

            console.log(loginObj);

            var totalLen = msgHead.length + buffer.length;
            console.log("total len is "+totalLen);
            var  loginMsg = Buffer.concat([msgHead,buffer],totalLen);

            this.websock.send(loginMsg);
        },

        talk:function (guid,type,toid,msg) {
            var MsgInfo = this.protocol.lookupType("chat.client.MsgInfo");

            //var payload = {guid:guid,to_type:"0","to_id":myId,data:{msg_type:"1",from_uid:"arthur",content:msg}};


            var payload = {guid:guid,toType:"0",toId:myId,data:{msgType:"1",fromUid:"arthur",content:msg}};
            //
            var msgHead = new Buffer(4);
            var msgInfo = MsgInfo.create(payload);

            var buffer  = MsgInfo.encode(msgInfo).finish();
            console.log(buffer);


            // this.parse_talk(buffer);
            // return;

            msgHead.writeInt16LE(buffer.length + 2, 0);
            var cmdId = 9;
            msgHead.writeInt16LE(cmdId, 2);


            var totalLen = msgHead.length + buffer.length ;
            console.log("total len is "+totalLen);
            var  msgProto = Buffer.concat([msgHead,buffer],totalLen);

            console.log(msgProto);
            this.websock.send(msgProto );
        },
    parse_talk:function(pbuf){
        var MsgInfo = this.protocol.lookupType("chat.client.MsgInfo");

        try {
            var msg = MsgInfo.decode(pbuf);
            console.log(msg);
            console.log("to id is ");

        } catch (e) {

            console.log(e);

        }
    },

    on_msg_list:function(pbuf)
    {
        var MsgInfoList = this.protocol.lookupType("chat.client.MsgInfoList");
        try {
            var msg = MsgInfoList.decode(pbuf);
            console.log(msg);
            kMsgList = msg.dataList;

            if(kMsgList.length !== 0)
            {
                this.send_msg("chat.client.MsgDataClientAck",5,{uid:this.myid,toType:msg.toType,toId:msg.toId,mid:kMsgList[kMsgList.length - 1].mid});
            }
        }
        catch(e)
        {

        }
    },

    on_msg_info:function(pbuf)
    {
        var MsgInfo = this.protocol.lookupType("chat.client.MsgInfo");


        try {
            var msg = MsgInfo.decode(pbuf);
            console.log(msg);
            app.messages.push(msg.data);


            console.log("mid is "+msg.data.mid)
            var  mid = msg.data.mid;
            this.send_msg("chat.client.MsgDataClientAck",5,{uid:this.myid,toType:msg.toType,toId:msg.toId,mid:mid})

        } catch (e) {

            console.log(e);

        }


    },

    on_talk:function (pbuf) {


        var MsgInfoClientAck = this.protocol.lookupType("chat.client.MsgDataClientAck");
        try {
            var clientAck = MsgInfoClientAck.decode(pbuf);
            console.log(clientAck);

        } catch (e) {

            console.log(e);

        }
    },
    send_msg:function (protoType,cmdId,payload) {
        var ProtoType = this.protocol.lookupType(protoType);
        var msgHead = new Buffer(4);
        var protoData = ProtoType.create(payload);

        var buffer  = ProtoType.encode(protoData).finish();
        console.log(buffer);

        msgHead.writeInt16LE(buffer.length + 2, 0);
        msgHead.writeInt16LE(cmdId, 2);

        var totalLen = msgHead.length + buffer.length;
        console.log("total len is "+totalLen);
        var  msgProto = Buffer.concat([msgHead,buffer],totalLen);

        console.log(msgProto);
        this.websock.send(msgProto );
    },


};

GChatClient.load_proto();




