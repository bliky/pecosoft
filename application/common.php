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

function import ($class)
{
  $class =str_replace(['.', '#'], [DIRECTORY_SEPARATOR, '.'], $class);
  list($name, $class) = explode(DIRECTORY_SEPARATOR, $class, 2);


  $rootPath = realpath(dirname($_SERVER['SCRIPT_FILENAME']) . DIRECTORY_SEPARATOR.'..') . DIRECTORY_SEPARATOR;
    $extendPath = $rootPath . 'extend' . DIRECTORY_SEPARATOR;

  $baseUrl = $extendPath . $name . DIRECTORY_SEPARATOR;
  $filename = $baseUrl . $class . '.php';

    return require $filename;
}

function create_dir ($dir)
{
  if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
  }
  if (!is_writable($dir)) {
    chmod($dir, 0777);
  }
}
