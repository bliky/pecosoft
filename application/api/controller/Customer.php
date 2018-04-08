<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\common\model\Customer as CustomerModel;

class Customer extends Controller
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
            $data = CustomerModel::where('cate', $cate)->page($page, $limit)->select();
            $count = CustomerModel::where('cate', $cate)->count();
        } else {
            $data = CustomerModel::where(1)->page($page, $limit)->select();
            $count = CustomerModel::count();
        }

        return rest_resp($data, $count);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
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
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
