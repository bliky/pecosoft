<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\common\model\Product as ProductModel;

class Product extends Controller
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

        //return $cate . $page . $limit;

        if (is_numeric($cate)) {
            $data = Db::table('v_product')->where('cate', $cate)->page($page, $limit)->select();
            $count = Db::table('v_product')->where('cate', $cate)->count();
        } else {
            $data = Db::table('v_product')->where(1)->page($page, $limit)->select();
            $count = Db::table('v_product')->count();
        }

        return rest_resp($data, $count);
    }

    /**
     * 显示创建资源表单页
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch('admin@index/product_create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $model = $request->param('model');
        $cate = $request->param('cate');

        $data = [
            'model' => $model,
            'cate' => $cate
        ];

        $res = ProductModel::create($data);

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
        $data = ProductModel::where('id', $id)->field('id,model,cate')->find();

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
        return $this->fetch('admin@index/product_edit');
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
        $model = $request->param('model');
        $cate = $request->param('cate');

        $data = [
            'model' => $model,
            'cate' => $cate
        ];

        $res = ProductModel::where('id', $id)->update($data);

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
        $res = ProductModel::destroy($id);
        return rest_resp($res, 1, 200);
    }
}
