<?php

namespace app\common\model;

use think\Db;
use think\Model;

class Department extends Model
{
    protected $table = 'department';
    public function getParentNameAttr($value, $data)
    {
        return Db::table('department')->where('id', $data['parent'])->value('name');
    }
    public function getLeaderNameAttr($value, $data)
    {
        return Db::table('employee')->where('id', $data['leader'])->value('name');
    }
}
