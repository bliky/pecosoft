/**

 @Name：PECO派客软件 增删改查通用接口
 @Author：koffi
 @Site：http://www.pecosoft.cn
 @License：LPPL
    
 */

 
layui.define(['layim'], function(exports){
  var layim = layui.layim,
        $ = layui.$;

  var webim = {
    init: function (user_id, cb) {
      var socket = new WebSocket('ws://www.pecosoft.com:8282');
      socket.onopen = function () {
      }
      socket.onmessage = function (e) {
        var data = eval("(" + e.data + ")");
        var type = data.type || '',
            client_id = data.client_id;
        switch(type) {
          case 'init' :
            $.post('/webim/bind', {uid: user_id, client_id: client_id}, function(res) {
              $.post('/webim/join', {gid: 100, client_id: client_id}, function(res) {
                cb(user_id, client_id);
              }, 'json');
            }, 'json');
            break;
          case 'chat' :
            var chat = data.chat,
                chat_type = chat.to.type,
                msg;
            if (chat_type === 'group') {
              msg = {
                username: chat.mine.username
                ,avatar: chat.mine.avatar
                ,id: chat.to.id
                ,type: chat_type
                ,content: chat.mine.content
                ,mine: false
                ,fromid: chat.mine.id
                ,timestamp: data.time * 1000
              };
            } else {
              msg = {
                username: chat.mine.username
                ,avatar: chat.mine.avatar
                ,id: chat.mine.id
                ,type: chat_type
                ,content: chat.mine.content
                ,mine: false
                ,fromid: chat.mine.id
                ,timestamp: data.time * 1000
              };
            }
            layim.getMessage(msg);
            webim.onchat && webim.onchat(chat, data.time);
            break;
          case 'push' :
            webim.onpush && webim.onpush(data.push);
            break;
          default :
            console.log(e.data);
        }
      }
    },
    kefu: function () {
      layim.config({
        init: {
          url: '/chat/init'
          ,type: 'get'
          ,data: {}
        },
        members: {
          url: '/chat/members'
          ,type: 'get'
          ,data: {}
        }
      });

      layim.on('sendMessage', function(res){
        webim.onsend && webim.onsend(res);
        var type = res.to.type;
        if (type == "group") {
          webim.send(0, res.to.id, {type:'chat', chat:res});
        } else {
          webim.send(res.to.id, 0, {type:'chat', chat:res});
        }
      })
    },
    send: function (uid, gid, msg) {
      $.post('/webim/send', {uid: uid, gid: gid, msg: JSON.stringify(msg)}, function(res) {
      }, 'json');
    },
    broadcast: function (msg) {
      $.post('/webim/broadcast', {msg: JSON.stringify(msg)}, function(res) {
      }, 'json');
    }
  };

  //对外暴露的接口
  exports('webim', webim);
});
