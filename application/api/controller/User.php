<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Cookie;

class User extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return $this->chat_info();
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('chat/init')
     */
    public function chat_init () {
        $cookies = new Cookie();
        $user_id = $cookies->get('user_id');
        $mine = Db::table('user')->where("id=$user_id")->field('id,name as username,avatar')->find();
        $mine['status'] = 'online';

        $user_list = Db::table('v_employee')->where('cate=1')->field('user_id as id, cate, name, avatar')->select();
        $user_list2 = Db::table('v_employee')->where('cate=2')->field('user_id as id, cate, name, avatar')->select();
        $friend_list = [];
        foreach ($user_list as $user) {
            $friend = [];
            $friend['id'] = $user['id'];
            $friend['username'] = $user['name'];
            $friend['avatar'] = $user['avatar'];
            $friend['status'] = 'online';
            $friend_list[] = $friend;
        }
        $friend_list2 = [];
        foreach ($user_list2 as $user) {
            $friend = [];
            $friend['id'] = $user['id'];
            $friend['username'] = $user['name'];
            $friend['avatar'] = $user['avatar'];
            $friend['status'] = 'online';
            $friend_list2[] = $friend;
        }

        $friend = [
            [
                'groupname' => '派单员',
                'id' => 101,
                'list' => $friend_list
            ],
            [
                'groupname' => '维修组长',
                'id' => 102,
                'list' => $friend_list2
            ]
        ];
        $group = [
            [
                'groupname' => '台群精机-内部群',
                'id' => 100,
                'avatar' => 'http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEJCzPkIBWdTYQx7qEM8DTkQgVyK2vBwItF7m3x35ZV8lLGr1lOJ8v7AmptF6BZ0FBBv8kJptqdJmQ/132'
            ]
        ];
        return chat_init_resp($mine, $friend, $group);
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('chat/members')
     */
    public function chat_members () {
        $user_list = Db::table('v_employee')->where('cate=1 OR cate=2')->field('user_id as id, cate, name, avatar')->select();
        $friend_list = [];
        foreach ($user_list as $user) {
            $friend = [];
            $friend['id'] = $user['id'];
            $friend['username'] = $user['name'];
            $friend['avatar'] = $user['avatar'];
            $friend['status'] = 'online';
            $friend_list[] = $friend;
        }
        return chat_members_resp($user_list);
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
