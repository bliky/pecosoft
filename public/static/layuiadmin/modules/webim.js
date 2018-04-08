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
      var socket = new WebSocket('ws://peco.fvtools.com:8282');
      socket.onopen = function () {
      }
      socket.onmessage = function (e) {
        var data = eval("(" + e.data + ")");
        var type = data.type || '',
            client_id = data.client_id;
        switch(type) {
          case 'init' :
            $.post('/webim/bind', {uid: user_id, client_id: client_id}, function(res) {
              cb(user_id, client_id);
            }, 'json');
            break;
          case 'chat' :
            webim.onchat && webim.onchat(data.chat);
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
    },
    send: function (uid, gid, msg) {
      $.post('/webim/send', {uid: uid, gid: gid, msg: JSON.stringify(msg)}, function(res) {
        console.log(res);
      }, 'json');
    },
    broadcast: function (msg) {
      $.post('/webim/broadcast', {msg: JSON.stringify(msg)}, function(res) {
        console.log(res);
      }, 'json');
    }
  };

  //对外暴露的接口
  exports('webim', webim);
});
