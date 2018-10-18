<?php
namespace linerController;
use linerModel\muscle;
class folder{
    private $_infomal;
    private $_db;
    private $_user;
    public function __construct($user_id){
        //�жϷ���ʽ�ļ����Ƿ���ڣ��������½�
        $this->_user = $user_id;
        $this->_db = muscle::getInstance()->dbh;
        
        $sql = "select * from folder";
        $sth = $this->_db->query($sql);
        $res = $sth->fetchAll();
        file_put_contents('/tmp/db6.log', json_encode($res));
        
        $informalFolderId = $this->getInformalFolder();
        if($informalFolderId === false){
            $this->setInformalFolder();
            $informalFolderId = $this->getInformalFolder();
        }
        $this->_infomal = $informalFolderId;
    }
    
    
    private function getInformalFolder(){
        $sql = "select id from folder where user_id = {$this->_user} and name = 'informal'";
        //file_put_contents('/tmp/db.log', $sql);
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
            return "�ļ�����ʧ��\n";
        }
    }
    
    
    public function getInformal(){
        return $this->_infomal;
    }
    
}
