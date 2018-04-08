<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function rest_resp($data, $count=0, $code=0, $msg='') {
	return json([
			'code' => $code,
			'msg' => $msg,
			'count' => $count,
			'data' => $data
		]);
}

function rource_resp($resource, $data, $count=0, $code=0, $msg='') {
	return json([
			'code' => $code,
			'msg' => $msg,
			'count' => $count,
			'data' => $data,
			'resource' => $resource
		]);
}

function chat_init_resp($mine, $friend, $group) {
	return json([
			'code' => 0,
			'msg' => '',
			'data' => [
				'mine' => $mine,
				'friend' => $friend,
				'group' => $group
			]
		]);
}

function chat_members_resp($list) {
	return json([
			'code' => 0,
			'msg' => '',
			'data' => [
				'list' => $list
			]
		]);
}
