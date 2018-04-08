/**

 @Name：PECO派客软件 产品管理
 @Author：koffi
 @Site：http://www.pecosoft.cn
 @License：LPPL
    
 */


layui.define(['admin', 'table', 'util'], function(exports){
  var $ = layui.$
  ,admin = layui.admin
  ,table = layui.table
  ,element = layui.element;

  var DISABLED = 'layui-btn-disabled'

  table.render({
    elem: '#LAY-app-all'
    ,url: '/weixin'
    ,page: true
    ,cols: [[
      {type: 'numbers', title: '序号', width: 60}
      ,{field: 'user_id', title: 'ID', width: 80}
      ,{field: 'avatar', title: '头像', width: 100, templet: '<div style=“overflow: hidden;”><img style="width: 80px; height:80px; object-fit: cover;" src="{{d.avatar}}"></div>'}
      ,{field: 'nickname', title: '昵称', width: 280}
      ,{field: 'openid', title: 'OPENID', minWidth: 200}
    ]]
    ,skin: 'row,line'
  });
  
  //事件处理
  var events = {
    del: function(othis, type){
      var thisTabs = tabs[type]
      ,checkStatus = table.checkStatus(thisTabs.id)
      ,data = checkStatus.data; //获得选中的数据
      if(data.length === 0) return layer.msg('未选中行');

      layer.confirm('确定删除选中的数据吗？', function(){
        /*
        admin.req('url', {}, function(){ //请求接口
          //do somethin
        });
        */
        //此处只是演示，实际应用需把下述代码放入上述Ajax回调中
        layer.msg('删除成功', {
          icon: 1
        });
        table.reload(thisTabs.id); //刷新表格
      });
    }
    ,ready: function(othis, type){
      var thisTabs = tabs[type]
      ,checkStatus = table.checkStatus(thisTabs.id)
      ,data = checkStatus.data; //获得选中的数据
      if(data.length === 0) return layer.msg('未选中行');
      
      //此处只是演示
      layer.msg('标记已读成功', {
        icon: 1
      });
      table.reload(thisTabs.id); //刷新表格
    }
    ,readyAll: function(othis, type){
      var thisTabs = tabs[type];
      
      //do somethin
      
      layer.msg(thisTabs.text + '：全部已读', {
        icon: 1
      });
    }
  };
  
  $('.LAY-app-btns .layui-btn').on('click', function(){
    var othis = $(this)
    ,thisEvent = othis.data('events')
    ,type = othis.data('type');
    events[thisEvent] && events[thisEvent].call(this, othis, type);
  });
  
  exports('weixin', {});
});
