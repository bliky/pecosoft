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

  curd.config($, 'cate_product');
  
  var DISABLED = 'layui-btn-disabled';
  
  //区分各选项卡中的表格
  var tabs = {
    all: {
      text: '产品分类'
      ,id: 'curd_table_all'
    }
  };

  var cols = [[
    {type: 'checkbox', fixed: 'left'}
    ,{type: 'numbers', title: '序号', width: 60}
    ,{field: 'name', title: '分类名称', width: 200}
    ,{fixed: 'right', width:180, align:'center', toolbar: '#toolBar'}
  ]];
  
  
  //全部
  table.render({
    elem: '#curd_table_all'
    ,url: '/cate_product'
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
        ,area: admin.screen() < 2 ? ['80%', '180px'] : ['500px', '180px']
        ,maxmin: true
        ,title: '添加产品分类'
        ,content: '/cate_product/create'
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
    console.log('toolbar', obj);

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
                      '<col width="80">' +
                      '<col width="100">' +
                      '<col>' +
                    '</colgroup><tbody>' +
                    '<tr><td>分类名称</td><td>' + data.name +  '</td></tr>' +
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
        ,area: admin.screen() < 2 ? ['80%', '180px'] : ['500px', '180px']
        ,maxmin: true
        ,title: '编辑部门'
        ,content: '/cate_product/'+data.id+'/edit'
        ,end: function (layero, index) {
          //同步更新缓存对应的值
          obj.update({
          });
        }
      });
    }
  });
  
  exports('cate_product', {});
});