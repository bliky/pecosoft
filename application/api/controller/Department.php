<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\common\model\Department as DepartmentModel;

class Department extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $data = Db::table('v_department2')->page($page, $limit)->select();
        $count = DepartmentModel::count();

        return rest_resp($data, $count);
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('ui/department')
     */
    public function ui_read () {
        $data = Db::table('department')->where(1)->field(['id', 'name'])->select();
        $count = Db::table('department')->count();

        return rource_resp('department', $data, $count);
    }

    /**
     * 显示创建资源表单页
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch('admin@index/department_create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $name = $request->param('name');
        $parent = $request->param('parent');
        $leader = $request->param('leader');
        $data = [
            'name' => $name,
            'parent' => $parent ? : 0,
            'leader' => $leader
        ];

        $res = DepartmentModel::create($data);

        return rest_resp($res->id, 1, 200);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $data = DepartmentModel::get($id);

        return rest_resp($data, 1, 200);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        return $this->fetch('admin@index/department_edit');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->param('name');
        $parent = $request->param('parent');
        $leader = $request->param('leader');
        $data = [
            'name' => $name,
            'parent' => $parent ? : 0,
            'leader' => $leader
        ];

        $res = DepartmentModel::where('id', $id)->update($data);

        return rest_resp($res, 1, 200);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = DepartmentModel::destroy($id);
        return rest_resp($res, 1, 200);
    }
}
