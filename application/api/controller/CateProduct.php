<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\common\model\CateProduct as CateProductModel;

class CateProduct extends Controller
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

        $data = CateProductModel::where(1)->page($page, $limit)->select();
        $count = CateProductModel::count();

        return rest_resp($data, $count);
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('ui/cate_product')
     */
    public function ui_read () {
        $data = Db::table('cate_product')->where(1)->field(['id', 'name'])->select();
        $count = Db::table('cate_product')->count();

        return rource_resp('cate_product', $data, $count);
    }

    /**
     * 显示创建资源表单页
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch('admin@index/cate_product_create');
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
        $data = [
            'name' => $name
        ];

        $res = CateProductModel::create($data);

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
        $data = CateProductModel::get($id);

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
        return $this->fetch('admin@index/cate_product_edit');
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
        $data = [
            'name' => $name
        ];

        $res = CateProductModel::where('id', $id)->update($data);

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
        $res = CateProductModel::destroy($id);
        return rest_resp($res, 1, 200);
    }
}
