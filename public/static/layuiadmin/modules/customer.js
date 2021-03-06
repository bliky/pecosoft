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
  
  //区分各选项卡中的表格
  ,tabs = {
    all: {
      text: '全部客户'
      ,id: 'LAY-app-all'
    }
  }

  ,cols = [[
    {type: 'checkbox', fixed: 'left'}
    ,{type: 'numbers', title: '序号', width: 60}
    ,{field: 'name', title: '姓名', width: 100}
    ,{field: 'contact', title: '联系方式', width: 150}
    ,{field: 'weixin', title: '绑定微信', width: 150}
    ,{field: 'province', title: '省', width: 100}
    ,{field: 'city', title: '市', width: 100}
    ,{field: 'area', title: '区', width: 100}
    ,{field: 'company_name', title: '公司', minwidth: 200}
    ,{field: 'company_address', title: '公司地址', minwidth: 200}
  ]];
  
  //标题内容模板
  var tplTitle = function(d){
    return '<a href="detail.html?id='+ d.id +'">'+ d.title;
  };
  
  //全部
  table.render({
    elem: '#LAY-app-all'
    ,url: '/customer'
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });

  //事件处理
  var events = {
    add: function(othis, type){
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
    ,del: function(othis, type){
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
    ,edit: function(othis, type){
      var thisTabs = tabs[type];
      
      //do somethin
      
      layer.msg(thisTabs.text + '：全部已读', {
        icon: 1
      });
    }
  };
  
  $('.LAY-app-message-btns .layui-btn').on('click', function(){
    var othis = $(this)
    ,thisEvent = othis.data('events')
    ,type = othis.data('type');
    events[thisEvent] && events[thisEvent].call(this, othis, type);
  });
  
  exports('customer', {});
});