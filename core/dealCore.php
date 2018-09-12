<?php
namespace linerCore;
class dealCore {
    private $_tb_item_id;
    private $_start_time;
    private $_end_time;
    private $_prices = array();
    
    
    protected function __construct($tb_item_id){
        $this->_tb_item_id = $tb_item_id;
    }
    
    
    
    
    
    
    
    
    private function recieveDetail(){
        $sql = "select * from item where tb_item_id = {$this->_tb_item_id}";
        $sth = $pdo->query($sql);

    }
    
}