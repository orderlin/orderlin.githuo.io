<?php
namespace linerController;
use linerModel\muscle;
class checkItem{
    
    static function insertCheckItem($db, $folder_id, $b2c, $b2c_id){
        $sql = "select count(*) from item where folder_id = {$folder_id} and b2c = {$b2c} and b2c_id = '{$b2c_id}'";
        $count = $db->query($sql)->fetchColumn();
        if($count == 0){
            $sql = "insert ignore into check_item (b2c, b2c_id, folder_id) value ({$b2c}, '{$b2c_id}', {$folder_id})";
            $rs = $db->query($sql);
            return $rs;
        }else{
            return ture;
        }
    }
    
}