<?php
namespace app\admin\controller;

use think\Controller;
use think\Cookie;

class Index extends Controller
{
  public function index ()
  {
  	$cookies = new Cookie();
    if (!($cookies->has('user_id') && $cookies->has('employee_id') && $cookies->has('account'))) {
    	$login_url = $cookies->get('login_url') ?: '/admin/login';
      	$cookies->clear('peco_');

      	return $this->redirect($login_url, 302);
    }

    $this->assign('name', $cookies->get('employee_name')?:'admin');
    return $this->fetch();
  }

  public function module ($mod)
  {
  	if ($mod != 'login') {
	  	$cookies = new Cookie();
	    if (!($cookies->has('user_id') && $cookies->has('employee_id') && $cookies->has('account'))) {
	    	$login_url = $cookies->get('login_url') ?: '/admin/login';
	      	$cookies->clear('peco_');

	      	return $this->redirect($login_url, 302);
	    }

      $this->assign('name', $cookies->get('employee_name')?:'admin');
      $this->assign('user_id', $cookies->get('user_id'));
    }

    return $this->fetch($mod);
  }
}
