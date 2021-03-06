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

  curd.config($, 'employee');
  
  var DISABLED = 'layui-btn-disabled';
  var tplCreateTime = function(d){
    var _date = new Date(d.create_time * 1000);
    return _date.getFullYear() + '-' + (_date.getMonth()+1) + '-' + _date.getDate() + ' ' + _date.getHours() + ':' + _date.getMinutes();
  };
  
  //区分各选项卡中的表格
  var tabs = {
    all: {
      text: '全部员工'
      ,id: 'curd_table_all'
    }
    ,type1: {
      text: '派单员'
      ,id: 'curd_table_type1'
    }
    ,type2: {
      text: '维修组长'
      ,id: 'curd_table_type2'
    }
    ,type2: {
      text: '维修组长'
      ,id: 'curd_table_type3'
    }
  }

  ,cols = [[
    {type: 'checkbox', fixed: 'left'}
    ,{type: 'numbers', title: '序号', width: 60}
    ,{field: 'name', title: '姓名', width: 100}
    ,{field: 'cate_text', title: '岗位', width: 100}
    ,{field: 'contact', title: '联系方式', width: 150}
    ,{field: 'account', title: '账号', width: 100}
    ,{field: 'passwd_init', title: '初始密码', width: 100}
    ,{field: 'province', title: '省', width: 100}
    ,{field: 'city', title: '市', width: 100}
    ,{field: 'area', title: '区', width: 100}
    ,{field: 'weixin', title: '绑定微信', minwidth: 150}
    ,{field: 'create_time', title: '添加时间', width: 170, templet:tplCreateTime}
    ,{fixed: 'right', width:180, align:'center', toolbar: '#toolBar'}
  ]];
  
  //全部
  table.render({
    elem: '#curd_table_all'
    ,url: '/employee'
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //分类1
  table.render({
    elem: '#curd_table_type1'
    ,url: '/employee'
    ,where: {cate: 1}
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //分类2
  table.render({
    elem: '#curd_table_type2'
    ,url: '/employee'
    ,where: {cate: 2}
    ,page: true
    ,cols: cols
    ,skin: 'row,line'
  });
  
  //分类3
  table.render({
    elem: '#curd_table_type3'
    ,url: '/employee'
    ,where: {cate: 3}
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
        ,area: admin.screen() < 2 ? ['80%', '450px'] : ['700px', '450px']
        ,maxmin: true
        ,title: '添加员工'
        ,content: '/employee/create'
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
                    '<tr><td>姓名</td><td>' + data.name +  '</td></tr>' +
                    '<tr><td>账号</td><td>' + data.account +  '</td></tr>' +
                    '<tr><td>初始密码</td><td>' + data.passwd_init +  '</td></tr>' +
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
        ,area: admin.screen() < 2 ? ['80%', '450px'] : ['700px', '450px']
        ,maxmin: true
        ,title: '编辑员工'
        ,content: '/employee/'+data.id+'/edit'
        ,end: function (layero, index) {
          //同步更新缓存对应的值
          obj.update({
          });
        }
      });
    }
  });
  
  exports('employee', {});
});