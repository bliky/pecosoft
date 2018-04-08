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
      text: '全部订单'
      ,id: 'LAY-app-all'
    }
    ,type1: {
      text: '待受理'
      ,id: 'LAY-app-status1'
    }
    ,type2: {
      text: '已受理'
      ,id: 'LAY-app-status2'
    }
    ,type3: {
      text: '派单中'
      ,id: 'LAY-app-status3'
    }
    ,type4: {
      text: '已接单'
      ,id: 'LAY-app-status4'
    }
    ,type5: {
      text: '进行中'
      ,id: 'LAY-app-status5'
    }
    ,type6: {
      text: '已完成'
      ,id: 'LAY-app-status6'
    }
    ,type7: {
      text: '已评价'
      ,id: 'LAY-app-status7'
    }
  }

  ,cols = [[
    {type: 'checkbox', fixed: 'left'}
    ,{type: 'numbers', title: '序号', width: 60}
    ,{field: 'sn', title: '订单号', minwidth: 100}
    ,{field: 'status_text', title: '受理状态', width: 100}
    ,{field: 'model', title: '产品型号', width: 150}
    ,{field: 'description', title: '报修描述', width: 100}
    ,{field: 'customer_name', title: '联系人', width: 100}
    ,{field: 'customer_contact', title: '联系方式', width: 100}
    ,{field: 'company_name', title: '客户公司', width: 100}
    ,{field: 'cjbh', title: '出机编号', width: 100}
    ,{field: 'cjrq', title: '出机日起', width: 80}
    ,{field: 'sfqk', title: '收费情况', width: 80}
    ,{field: 'ghpj', title: '更换配件', width: 80}
    ,{field: 'wxnr', title: '维修内容', width: 200}
    ,{field: 'beizhu', title: '维修备注', width: 200}
    ,{field: 'pingjia', title: '客户评价', width: 200}
    ,{field: 'create_time', title: '报修时间', width: 200}
  ]];
  
  //标题内容模板
  var tplTitle = function(d){
    return '<a href="detail.html?id='+ d.id +'">'+ d.title;
  };
  
  //全部
  table.render({
    elem: '#LAY-app-all'
    ,url: '/order'
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //待受理
  table.render({
    elem: '#LAY-app-status1'
    ,url: '/order'
    ,where: {status: 1}
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //已受理
  table.render({
    elem: '#LAY-app-status2'
    ,url: '/order'
    ,where: {status: 2}
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //派单中
  table.render({
    elem: '#LAY-app-status3'
    ,url: '/order'
    ,where: {status: 3}
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });

  //已接单
  table.render({
    elem: '#LAY-app-status4'
    ,url: '/order'
    ,where: {status: 4}
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //进行中
  table.render({
    elem: '#LAY-app-status5'
    ,url: '/order'
    ,where: {status: 5}
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //已完成
  table.render({
    elem: '#LAY-app-status6'
    ,url: '/order'
    ,where: {status: 6}
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });

  //已评价
  table.render({
    elem: '#LAY-app-status7'
    ,url: '/order'
    ,where: {status: 7}
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
  
  $('.LAY-app-btns .layui-btn').on('click', function(){
    var othis = $(this)
    ,thisEvent = othis.data('events')
    ,type = othis.data('type');
    events[thisEvent] && events[thisEvent].call(this, othis, type);
  });
  
  exports('order', {});
});