<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Cookie;

class Login extends Controller
{
    public function postAdmin (Request $request) {
      $account = $request->param('account');
      $passwd = $request->param('passwd');

      $res = Db::table('employee')->where("account = '$account' AND passwd_init = '$passwd'")->find();

      if (empty($res)) {
        return json(array('code'=>404, 'msg'=>'账号密码错误'));
      } else {
        $cookies = new Cookie();
        $cookies->set('user_id', $res['user_id']);
        $cookies->set('employee_id', $res['id']);
        $cookies->set('account', $res['account']);
        $cookies->set('employee_name', $res['name']);
        $access_token = md5($account . $passwd);
        $cookies->set('access_token', $access_token);
        $cookies->set('login_url', '/admin/login');

        $data = array(
          'access_token' => $access_token
        );
        return json(array('code'=>0, 'msg'=>'', 'data'=>$data));
      }
    }

    public function getExit () {
      $cookies = new Cookie();
      $login_url = $cookies->get('login_url') ?: '/admin/login';
      $cookies->clear('peco_');

      $this->redirect($login_url, 302);
    }
}
