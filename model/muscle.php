<?php
namespace linerModel;

class muscle{
    
    protected static $_instance = null;
    
    protected $dbName;
    
    protected $dsn;
    
    protected $dbh;
    
    
    
    /**
    
    * 构造
    
    *
    
    * @return DAOPDO
    
    */
    
    private function __construct($dbHost = '127.0.0.1', $dbUser = 'muscle', $dbPasswd = 'muscle', $dbName = 'muscle', $dbCharset = 'utf8')
    
    {
       
        try {
            
            $this->dsn = 'mysql:host='.$dbHost.';dbname='.$dbName;
            
            $this->dbh = new \PDO($this->dsn, $dbUser, $dbPasswd);
            file_put_contents('/tmp/db2.log', json_encode($this->dsn));
            file_put_contents('/tmp/db3.log', json_encode($this->dbh));
            $this->dbh->exec('SET character_set_connection='.$dbCharset.', character_set_results='.$dbCharset.', character_set_client=binary');
            
        } catch (PDOException $e) {
            
            $this->outputError($e->getMessage());
            
        }
        
    }
    
    
    
    /**
    
    * 防止克隆
    
    *
    
    */
    
    private function __clone() {}
    
    
    
    /**
    
    * Singleton instance
    
    *
    
    * @return Object
    
    */
    
    public static function getInstance()
    
    {
        
        if (self::$_instance === null) {
            self::$_instance = new self();
            
        }
        
        return self::$_instance;
        
    }
    
    
    
 
    
    

   
   
    
    /**
    
    * 获取表引擎
    
    *
    
    * @param String $dbName 库名
    
    * @param String $tableName 表名
    
    * @param Boolean $debug
    
    * @return String
    
    */
    
    public function getTableEngine($dbName, $tableName)
    
    {
        
        $strSql = "SHOW TABLE STATUS FROM $dbName WHERE Name='".$tableName."'";
        
        $arrayTableInfo = $this->query($strSql);
        
        $this->getPDOError();
        
        return $arrayTableInfo[0]['Engine'];
        
    }
    
    //预处理执行
    
    public function prepareSql($sql=''){
        
        return $this->dbh->prepare($sql);
        
    }
    
    //执行预处理
    
    public function execute($presql){
        
        return $this->dbh->execute($presql);
        
    }
    
    
    
    /**
    
    * pdo属性设置
    
    */
    
    public function setAttribute($p,$d){
        
        $this->dbh->setAttribute($p,$d);
        
    }
    
    
    
    /**
    
    * beginTransaction 事务开始
    
    */
    
    public function beginTransaction()
    
    {
        
        $this->dbh->beginTransaction();
        
    }
    
    
    
    /**
    
    * commit 事务提交
    
    */
    
    public function commit()
    
    {
        
        $this->dbh->commit();
        
    }
    
    
    
    /**
    
    * rollback 事务回滚
    
    */
    
    public function rollback()
    
    {
        
        $this->dbh->rollback();
        
    }
    
    
    
    /**
    
    * transaction 通过事务处理多条SQL语句
    
    * 调用前需通过getTableEngine判断表引擎是否支持事务
    
    *
    
    * @param array $arraySql
    
    * @return Boolean
    
    */
    
    public function execTransaction($arraySql)
    
    {
        
        $retval = 1;
        
        $this->beginTransaction();
        
        foreach ($arraySql as $strSql) {
            
            if ($this->execSql($strSql) == 0) $retval = 0;
            
        }
        
        if ($retval == 0) {
            
            $this->rollback();
            
            return false;
            
        } else {
            
            $this->commit();
            
            return true;
            
        }
        
    }
    
    
    
    /**
    
    * checkFields 检查指定字段是否在指定数据表中存在
    
    *
    
    * @param String $table
    
    * @param array $arrayField
    
    */
    
    private function checkFields($table, $arrayFields)
    
    {
        
        $fields = $this->getFields($table);
        
        foreach ($arrayFields as $key => $value) {
            
            if (!in_array($key, $fields)) {
                
                $this->outputError("Unknown column `$key` in field list.");
                
            }
            
        }
        
    }
    
    
    
    
    /**
    
    * getPDOError 捕获PDO错误信息
    
    */
    
    private function getPDOError()
    
    {
        
        if ($this->dbh->errorCode() != '00000') {
            
            $arrayError = $this->dbh->errorInfo();
            
            $this->outputError($arrayError[2]);
            
        }
        
    }
    
    
    
    /**
    
    * debug
    
    *
    
    * @param mixed $debuginfo
    
    */
    
    private function debug($debuginfo)
    
    {
        
        var_dump($debuginfo);
        
        exit();
        
    }
    
    
    
    /**
    
    * 输出错误信息
    
    *
    
    * @param String $strErrMsg
    
    */
    
    private function outputError($strErrMsg)
    
    {
        
        throw new Exception('MySQL Error: '.$strErrMsg);
        
    }
    
    
    
    /**
    
    * destruct 关闭数据库连接
    
    */
    
    public function destruct()
    
    {
        
        $this->dbh = null;
        
    }
    
    /**
    
    *PDO执行sql语句,返回改变的条数
    
    *如需调试可选用execSql($sql,true)
    
    */
    
    public function exec($sql=''){
        
        return $this->dbh->exec($sql);
        
    }

}

