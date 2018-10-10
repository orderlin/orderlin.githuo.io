<?php
namespace linerController;
use linerModel\muscle;
class folder{
    private $_infomal;
    private $_db;
    private $_user;
    public function __construct($user_id){
        //判断非正式文件夹是否存在，不存在新建
        $this->_user = $user_id;
        $this->_db = muscle::getInstance();
        $DBjson = json_encode($this->_db);
        //file_put_contents('/tmp/db.log', $DBjson);
        $informalFolderId = $this->getInformalFolder();
        if($informalFolderId === false){
            $this->setInformalFolder();
            $informalFolderId = $this->getInformalFolder();
        }
        $this->_infomal = $informalFolderId;
    }
    
    
    private function getInformalFolder(){
        $sql = "select id from folder where user_id = {$this->_user} and name = 'informal'";
        $sth = $this->_db->query($sql);
        $folder_id = $sth->fetchColumn();
        if($folder_id > 0){
            $this->_infomal = $folder_id;
            return $this->_infomal;
        }else{
            return false;
        }
    }
    
    private function setInformalFolder(){
        $sql = "insert into folder (user_id, name) value ({$this->_user}, 'informal')";
        $sth = $this->_db->query($sql);
        if(!$sth){
            return "文件创建失败\n";
        }
    }
    
    
    public function getInformal(){
        return $this->_infomal;
    }
    
}
