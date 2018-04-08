/**

 @Name：PECO派客软件 增删改查通用接口
 @Author：koffi
 @Site：http://www.pecosoft.cn
 @License：LPPL
    
 */

 
layui.define(function(exports){
  var $ = layui.$;

  var fullscreen = {
    isfull: function () {
      return document.fullScreen||document.mozFullScreen||document.webkitIsFullScreen;
    },
    open: function (el) {
      var isFullscreen=document.fullScreen||document.mozFullScreen||document.webkitIsFullScreen;
      var el = el || document.body;

      if (!isFullscreen) {
        var q = parent.layui.$;
        q(q('iframe')[0]).attr('allowfullscreen', true);

        (el.requestFullscreen && el.requestFullscreen()) ||
        (el.mozRequestFullScreen && el.mozRequestFullScreen()) ||
        (el.webkitRequestFullscreen && el.webkitRequestFullscreen()) || (el.msRequestFullscreen && el.msRequestFullscreen());
      }
    },
    close: function () {
      var isFullscreen=document.fullScreen||document.mozFullScreen||document.webkitIsFullScreen;

      if (isFullscreen) {
        document.exitFullscreen?document.exitFullscreen():
        document.mozCancelFullScreen?document.mozCancelFullScreen():
        document.webkitExitFullscreen?document.webkitExitFullscreen():'';
      }
    }
  }

  exports('fullscreen', fullscreen);
});
