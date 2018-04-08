<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;

class Area extends Controller
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

        $data = Db::table('v_area')->where(1)->page($page, $limit)->select();
        $count = Db::table('v_area')->count();

        return rest_resp($data, $count);
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('ui/province')
     */
    public function ui_province () {
        $data = Db::table('provinces')->where(1)->field('provinceid as id, province as name')->select();
        $count = Db::table('provinces')->count();

        return rource_resp('province', $data, $count);
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('ui/city/:provinceid')
     */
    public function ui_city ($provinceid) {
        $data = Db::table('cities')->where('provinceid', $provinceid)->field('cityid as id, city as name')->select();
        $count = Db::table('cities')->where('provinceid', $provinceid)->count();

        return rource_resp('city', $data, $count);
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('ui/area/:cityid')
     */
    public function ui_area ($cityid) {
        $data = Db::table('areas')->where('cityid', $cityid)->field('areaid as id, area as name')->select();
        $count = Db::table('areas')->where('cityid', $cityid)->count();

        return rource_resp('area', $data, $count);
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
