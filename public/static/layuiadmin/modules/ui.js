/**

 @Name：PECO派客软件 增删改查通用接口
 @Author：koffi
 @Site：http://www.pecosoft.cn
 @License：LPPL
    
 */

 
layui.define(function(exports){
  var $ = layui.$
  ,layer = layui.layer;

  var render_opts = function (opts, elm) {
    var html = '<option value=""></option>';
    if (opts.length) {
      for (var i=0; i<opts.length; i++) {
        var opt = opts[i];
        html += '<option value="' + opt.id + '">' + opt.name + '</option>';
      }
    }
    elm.innerHTML = html;
    return html;
  };

  var peco_ui = {
    selects: [],
    localdata: {},
    count: 0,
    lock: false,
    $: null,
    reset: function (resource) {
      render_opts([], document.getElementById('ui_select_'+resource));
    },
    update: function (resource, param, cb) {
      var api = '/ui/' + resource + '/' + param;
      var th = this;
      th.$.get(api, {}, function(res) {
        var resource = res.resource;
        th.localdata[resource] = { count: res.count, data: res.data};
        var opts = th.localdata[resource].data;
        var opts_html = render_opts(opts, document.getElementById('ui_select_'+resource));
        cb();
      }, 'json')
    },
    init: function ($, selects, cb) {
      var th = this;
      th.count = 0;
      th.lock = false;
      th.selects = selects;
      th.$ = $;
      var selects = th.selects;

      for (var i=0; i<selects.length; i++) {
        var api = '/ui/' + selects[i];

        $.get(api, {}, function(res) {
          var resource = res.resource;
          th.localdata[resource] = { count: res.count, data: res.data};
          var opts = th.localdata[resource].data;
          var opts_html = render_opts(opts, document.getElementById('ui_select_'+resource));

          th.count++;
          if (th.count === th.selects.length && !th.lock) {
            th.lock = true;
            cb();
          }
        }, 'json')
      }
    }
  };


  //对外暴露的接口
  exports('ui', peco_ui);
});