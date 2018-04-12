<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\common\lib\Excel;

class Export extends Controller
{
    public function getExcel(Request $request) {
      $table = $request->param('t');
      $title = $request->param('tt');
      //$cols = $request->param('c');
      $cols = [
        ['title'=>'省', 'field'=>'province', 'width'=>10],
        ['title'=>'市', 'field'=>'city', 'width'=>10],
        ['title'=>'区', 'field'=>'area', 'width'=>10],
        ['title'=>'公司', 'field'=>'company_name', 'width'=>20],
        ['title'=>'联系人', 'field'=>'name', 'width'=>10],
        ['title'=>'联系方式', 'field'=>'contact', 'width'=>20],
        ['title'=>'详细地址', 'field'=>'company_address', 'width'=>50]
      ];
      //$data = Db::table($table)->select();
      //return $this->saveExcel($cols, $data, $table, $title);
    }

    private function saveExcel($cols, $data, $filename, $title) {
      $excel = new Excel($cols, $data);
      $excel->writeSheet($title);
      return $excel->save($filename);
    }
}
