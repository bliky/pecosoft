/**

 @Name：PECO派客软件 增删改查通用接口
 @Author：koffi
 @Site：http://www.pecosoft.cn
 @License：LPPL
    
 */

 
layui.define(function(exports){
  var $ = layui.$
  ,layer = layui.layer;

  var peco_curd = {
    resource: null,
    $: null,
    config: function (jQuery, resource) {
      var $ = this.$ = jQuery;
      this.resource = '/' + resource;
      $.each(["put", "delete"], function(t,e) {
        $[e] = function(t,r,n,s) {
          return $.isFunction(r) && (s=s||n,n=r,r=void 0),
          $.ajax({
            url:t,
            type:e,
            dataType:s,
            data:r,
            success:n})
        }
      });
    },
    checkCode: function (o) {
      if (o.code != 200) return false;
      return true;
    },
    create: function (data, cb) {
      var th = this;
      this.$.post(this.resource, data, function (res) {
        if (!th.checkCode(res)) return;
        cb();
      }, 'json');
    },
    update: function (id, data, cb) {
      var url = this.resource + '/' + id,
          th = this;
      this.$.put(url, data, function (res) {
        if (!th.checkCode(res)) return;
        cb();
      }, 'json');
    },
    read: function (id, cb) {
      var url = this.resource + '/' + id,
          th = this;
      this.$.get(url, {}, function (res) {
        if (!th.checkCode(res)) return;
        cb(res.data);
      }, 'json');
    },
    delete: function (id, cb) {
      var url = this.resource + '/' + id,
          th = this;
      this.$.delete(url, {}, function (res) {
        if (!th.checkCode(res)) return;
        cb();
      }, 'json');
    }
  };

  //对外暴露的接口
  exports('curd', peco_curd);
});