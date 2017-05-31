<?php
namespace app\common\controller;
use think\Controller;
use think\Db;

/**
* 关于表中设置唯一，insert和insertGetID不返回值的解决方法
*/
class Dbinsert extends controller
{
    static public function DbIns($table, array $data = []){
        if (is_string($table) && (!empty($table))) {            
            if (!$table1 = model($table))
                $this->error = $table1 . "模型不存在！";
        }
        // halt($data);
        halt(Db::name($table)->fetchSql(true)->insert($data));
        $AddDb = Db::name($table)->fetchSql(true)->insertGetId($data);
        halt($AddDb);
        $result = Db::execute(str_replace("INSERT", "INSERT IGNORE", $AddDb));

        return $result;

    }
}