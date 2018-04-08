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
      text: '客户反馈'
      ,id: 'LAY-app-all'
    }
    ,type1: {
      text: '技术咨询'
      ,id: 'LAY-app-type1'
    }
    ,type2: {
      text: '投诉建议'
      ,id: 'LAY-app-type2'
    }
  }

  ,cols = [[
    {type: 'checkbox', fixed: 'left'}
    ,{type: 'numbers', title: '序号', width: 60}
    ,{field: 'cate_text', title: '反馈类型', width: 100}
    ,{field: 'customer_name', title: '联系客户', width: 100}
    ,{field: 'contact', title: '联系方式', width: 160}
    ,{field: 'content', title: '内容', width: 500}
    ,{field: 'company_name', title: '客户公司', width: 100}
    ,{field: 'company_address', title: '公司地址', width: 200}
    ,{field: 'create_time', title: '反馈时间', width: 180}
  ]];
  
  //标题内容模板
  var tplTitle = function(d){
    return '<a href="detail.html?id='+ d.id +'">'+ d.title;
  };
  
  //全部
  table.render({
    elem: '#LAY-app-all'
    ,url: '/fankui'
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //分类1
  table.render({
    elem: '#LAY-app-type1'
    ,url: '/fankui'
    ,where: {cate: 1}
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //分类2
  table.render({
    elem: '#LAY-app-type2'
    ,url: '/fankui'
    ,where: {cate: 2}
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
  
  exports('fankui', {});
});