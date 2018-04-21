<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\common\model\MapMarker as MapMarkerModel;

class MapMarker extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = MapMarkerModel::field('id,name,description as des,lng,lat')->select();
        $count = MapMarkerModel::count();

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
        $name = $request->param('name');
        $des = $request->param('des');
        $lng = $request->param('lng');
        $lat = $request->param('lat');

        $data = [
            'name' => $name,
            'description' => $des,
            'lng' => $lng,
            'lat' => $lat
        ];

        $res = MapMarkerModel::create($data);

        return rest_resp($res->id, 1, 200, '位置添加成功');
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
