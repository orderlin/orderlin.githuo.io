<?php
namespace linerController;
use linerModel\muscle;
class checkItem{
    
    static function insertCheckItem($folder_id, $b2c, $b2c_id){
        $db = muscle::getInstance()->dbh;
        $sql = "select count(*) from item where folder_id = {$folder_id} and b2c = {$b2c} and b2c_id = '{$b2c_id}'";
        $count = $db->query($sql)->fetchColumn();
        if($count){
            return true;
        }else{
            $sql = "insert ignore into check_item (b2c, b2c_id, folder_id) value ({$b2c}, '{$b2c_id}', {$folder_id})";
            file_put_contents('/tmp/sql.log', $sql)
            $rs = $db->query($sql);
            return $rs;
        }
    }
    
}