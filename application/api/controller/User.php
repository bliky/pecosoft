<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;

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
        $user_list = Db::table('user')->field('id, name, status, avatar')->limit(1, 8)->select();
        $friend_list = [];
        foreach ($user_list as $user) {
            $friend = [];
            $friend['id'] = $user['id'];
            $friend['username'] = $user['name'];
            $friend['avatar'] = $user['avatar'];
            $friend['status'] = $user['status'] === 0 ? 'online' : 'hide';
            $friend_list[] = $friend;
        }

        $mine = [
            'username' => 'KF',
            'id' => 1,
            'status' => 'online',
            'avatar' => 'http://wx.qlogo.cn/mmhead/Q3auHgzwzM5fxzwmJThryQdricAuic3pdptw07saKxMTww7NDzF4SLfg/0'
        ];
        $friend = [
            [
                'groupname' => '台群售服部',
                'id' => 2,
                'list' => $friend_list
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
        $user_list = Db::table('user')->field('id, name, status, avatar')->limit(10, 20)->select();
        $friend_list = [];
        foreach ($user_list as $user) {
            $friend = [];
            $friend['id'] = $user['id'];
            $friend['username'] = $user['name'];
            $friend['avatar'] = $user['avatar'];
            $friend['status'] = $user['status'] === 0 ? 'online' : 'hide';
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
