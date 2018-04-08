<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\common\model\Employee as EmployeeModel;

class Employee extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $cate = $this->request->param('cate');
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        if (is_numeric($cate)) {
            $data = Db::table('v_employee')->where('cate', $cate)->page($page, $limit)->select();
            $count = Db::table('v_employee')->where('cate', $cate)->count();
        } else {
            $data = Db::table('v_employee')->where(1)->page($page, $limit)->select();
            $count = Db::table('v_employee')->count();
        }

        return rest_resp($data, $count);
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('ui/employee')
     */
    public function ui_read () {
        $data = Db::table('employee')->where('cate', '<>', 3)->field(['id', 'name'])->select();
        $count = Db::table('employee')->where('cate', '<>', 3)->count();

        return rource_resp('employee', $data, $count);
    }

    /**
     * 显示创建资源表单页
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch('admin@index/employee_create');
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
        $mobile = $request->param('contact');
        $account = $request->param('account');
        $passwd_init = $request->param('passwd_init');
        $cate = $request->param('cate');
        $provinceid = $request->param('provinceid');
        $cityid = $request->param('cityid');
        $areaid = $request->param('areaid');
        $data = [
            'name' => $name,
            'mobile' => $mobile,
            'account' => $account,
            'passwd_init' => $passwd_init,
            'cate' => $cate,
            'provinceid' => $provinceid,
            'cityid' => $cityid,
            'areaid' => $areaid
        ];

        $res = EmployeeModel::create($data);

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
        $data = EmployeeModel::where('id', $id)->field('id,name,mobile as contact,cate,account,passwd_init,provinceid,cityid,areaid')->find();

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
        return $this->fetch('admin@index/employee_edit');
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
        $mobile = $request->param('contact');
        $account = $request->param('account');
        $passwd_init = $request->param('passwd_init');
        $cate = $request->param('cate');
        $provinceid = $request->param('provinceid');
        $cityid = $request->param('cityid');
        $areaid = $request->param('areaid');
        $data = [
            'name' => $name,
            'mobile' => $mobile,
            'account' => $account,
            'passwd_init' => $passwd_init,
            'cate' => $cate,
            'provinceid' => $provinceid,
            'cityid' => $cityid,
            'areaid' => $areaid
        ];

        $res = EmployeeModel::where('id', $id)->update($data);

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
        $res = EmployeeModel::destroy($id);
        return rest_resp($res, 1, 200);
    }
}
