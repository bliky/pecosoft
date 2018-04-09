/**

 @Name：PECO派客软件 增删改查通用接口
 @Author：koffi
 @Site：http://www.pecosoft.cn
 @License：LPPL
    
 */
 
layui.define(function(exports){
  var $ = layui.$
  ,layer = layui.layer
  ,laytpl = layui.laytpl
  ,setter = layui.setter
  ,view = layui.view
  ,admin = layui.admin
  
  //公共业务的逻辑处理可以写在此处，切换任何页面都会执行
  //……

  //退出
  admin.events.logout = function(){
    location.href = '/login/exit';
  };

  
  //对外暴露的接口
  exports('common', {});
});