<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use GatewayClient\Gateway;

class Webim extends Controller
{
    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('webim/bind', 'post')
     */
    public function bind (Request $request) {
    	Gateway::$registerAddress = '127.0.0.1:1238';
    	$user_id = $request->param('uid');
    	$client_id = $request->param('client_id');

    	Gateway::bindUid($client_id, $user_id);
    	return json(['code'=>200, 'data'=>$user_id]);
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('webim/join', 'post')
     */
    public function join (Request $request) {
    	Gateway::$registerAddress = '127.0.0.1:1238';
    	$group_id = $request->param('gid');
    	$client_id = $request->param('client_id');

    	Gateway::joinGroup($client_id, $group_id);
    	return json(['code'=>200, 'data'=>$group_id]);
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('webim/send', 'post')
     */
    public function send (Request $request) {
    	Gateway::$registerAddress = '127.0.0.1:1238';
    	$user_id = $request->param('uid') ? : 0;
    	$group_id = $request->param('gid') ? : 0;
    	$message = $request->param('msg') ? : '';
        
        $message = json_decode($message, true);
        $message['time'] = time();
        $message = json_encode($message);

    	$user_id && Gateway::sendToUid($user_id, $message);
    	$group_id && Gateway::sendToGroup($group_id, $message);
    }

    /**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('webim/broadcast', 'post')
     */
    public function broadcast (Request $request) {
    	Gateway::$registerAddress = '127.0.0.1:1238';
    	$message = $request->param('msg');

    	Gateway::sendToAll($message);
    }
}
