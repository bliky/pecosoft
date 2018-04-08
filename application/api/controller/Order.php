<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\common\model\Order as OrderModel;

class Order extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $status = $this->request->param('status');
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        if (is_numeric($status)) {
            $data = OrderModel::where('status', $status)->page($page, $limit)->select();
            $count = OrderModel::where('status', $status)->count();
        } else {
            $data = OrderModel::where(1)->page($page, $limit)->select();
            $count = OrderModel::count();
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
