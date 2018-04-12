<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::resource('product','api/Product');
Route::resource('employee','api/Employee');
Route::resource('customer','api/Customer');
Route::resource('order','api/Order');
Route::resource('fankui','api/Fankui');
Route::resource('cate_product','api/CateProduct');
Route::resource('area','api/Area');
Route::resource('company','api/Company');
Route::resource('weixin','api/Weixin');
Route::resource('menu','api/Menu');
Route::resource('department','api/Department');
Route::resource('user','api/User');

Route::get('admin$', 'admin/Index/index');
Route::get('admin/:mod$','admin/Index/module');

Route::controller('login','api/Login');
Route::controller('export','api/Export');

return [

];
