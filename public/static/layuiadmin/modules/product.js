/**

 @Name：PECO派客软件 产品管理
 @Author：koffi
 @Site：http://www.pecosoft.cn
 @License：LPPL
    
 */


layui.define(['admin', 'table', 'util', 'curd'], function(exports){
  var $ = layui.$
  ,admin = layui.admin
  ,curd = layui.curd
  ,table = layui.table
  ,element = layui.element;

  curd.config($, 'product');
  
  var DISABLED = 'layui-btn-disabled';
  var tplCreateTime = function(d){
    var _date = new Date(d.create_time * 1000);
    return _date.getFullYear() + '-' + (_date.getMonth()+1) + '-' + _date.getDate() + ' ' + _date.getHours() + ':' + _date.getMinutes();
  };
  
  //区分各选项卡中的表格
  var tabs = {
    all: {
      text: '全部产品'
      ,id: 'curd_table_all'
    }
    ,notice: {
      text: '金属加工中心'
      ,id: 'curd_table_type1'
    }
    ,direct: {
      text: '玻璃加工中心'
      ,id: 'curd_table_type2'
    }
  }

  ,cols = [[
      {type: 'checkbox', fixed: 'left'}
      ,{type: 'numbers', title: '序号', width: 60}
      ,{field: 'model', title: '型号', width: 160}
      ,{field: 'cate_text', title: '分类', width: 160}
      ,{field: 'avatar', title: '图片', minWidth: 160}
      ,{field: 'create_time', title: '添加时间', width:160, templet: tplCreateTime}
      ,{fixed: 'right', width:180, align:'center', toolbar: '#toolBar'}
  ]];
  
  //标题内容模板
  var tplTitle = function(d){
    return '<a href="detail.html?id='+ d.id +'">'+ d.title;
  };
  
  //全部
  table.render({
    elem: '#curd_table_all'
    ,url: '/product'
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //分类1
  table.render({
    elem: '#curd_table_type1'
    ,url: '/product'
    ,where: {cate: 1}
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //分类2
  table.render({
    elem: '#curd_table_type2'
    ,url: '/product'
    ,where: {cate: 2}
    ,page: true
    ,cols: cols
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
        var count = 0,
            len = data.length;
        for (var i=0; i<len; i++) {
          var id = data[i].id;
          curd.delete(id, function () {
            count++;
            if (count==len) {
              layer.msg('删除成功', {
                icon: 1
              });
              table.reload(thisTabs.id);
            }
          })
        }
      });
    }
    ,add: function(othis, type){
      var thisTab = tabs[type];
      
      layer.open({
        type: 2
        ,shadeClose: true
        ,area: admin.screen() < 2 ? ['80%', '300px'] : ['600px', '280px']
        ,maxmin: true
        ,title: '添加产品'
        ,content: '/product/create'
        ,end: function (layero, index) {
          table.reload(thisTab.id);
        }
      });
    }
  };
  
  $('.peco-app-btns .layui-btn').on('click', function(){
    var othis = $(this)
    ,thisEvent = othis.data('events')
    ,type = othis.data('type');
    events[thisEvent] && events[thisEvent].call(this, othis, type);
  });

  //监听工具条
  table.on('tool(peco_table)', function(obj){
    var data = obj.data;
    var layEvent = obj.event;
    var tr = obj.tr; //获得当前行 tr 的DOM对象
   
    if(layEvent === 'detail'){ //查看
      layer.open({
        type: 1
        ,shadeClose: true
        ,area: admin.screen() < 2 ? ['80%'] : ['380px']
        ,maxmin: true
        ,title: '查看'
        ,content: '<div style="margin: 15px;"><table class="layui-table" lay-skin="row,line">' + 
                    '<colgroup>' +
                      '<col width="100">' +
                      '<col width="200">' +
                      '<col>' +
                    '</colgroup><tbody>' +
                    '<tr><td>型号</td><td>' + data.model +  '</td></tr>' +
                  '</tbody></table></div>'
      });
    } else if(layEvent === 'del'){ //删除
      layer.confirm('真的删除行么', function(index){
        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
        layer.close(index);
        //向服务端发送删除指令
        curd.delete(data.id, function () {
          layer.msg('删除成功', {
            icon: 1
          });
        })
      });
    } else if(layEvent === 'edit'){ //编辑
      layer.open({
        type: 2
        ,shadeClose: true
        ,area: admin.screen() < 2 ? ['80%', '300px'] : ['600px', '280px']
        ,maxmin: true
        ,title: '编辑部门'
        ,content: '/product/'+data.id+'/edit'
        ,end: function (layero, index) {
          //同步更新缓存对应的值
          obj.update({
          });
        }
      });
    }
  });
  
  exports('product', {});
});