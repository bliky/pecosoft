<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
  public function index ()
  {
    return $this->fetch();
  }

  public function module ($mod)
  {
    return $this->fetch($mod);
  }
}
