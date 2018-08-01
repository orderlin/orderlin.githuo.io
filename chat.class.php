<?php
class chat{
    private $_ToUserName;
    private $_FromUserName;
    private $_CreateTime;
    private $_MsgType;
    private $_Content;
    private $_MsgId;
    private $_PicUrl;
    private $_MediaId;
    private $_Format;
    private $_Recognition;
    private $_ThumbMediaId;
    static private $chat;
    /*
     * api_type 决定是否开启API对话
     */
    private $_API_TYPE = 0;
     
    /*
     * 构造函数填充基础属性
     */
    public function __construct($postObj){
        if(isset($postObj->_FromUserName)) $this->setToUserName($postObj->_FromUserName);
        if(isset($postObj->_ToUserName)) $this->setFromUserName($postObj->_ToUserName);
        if(isset($postObj->_CreateTime)) $this->setCreateTime($postObj->_CreateTime);
        if(isset($postObj->_MsgType)) $this->setMsgType($postObj->_MsgType);
        if(isset($postObj->_Content)) $this->setContent($postObj->_Content);
        if(isset($postObj->_MsgId)) $this->setMsgId($postObj->_MsgId);
        if(isset($postObj->_PicUrl)) $this->setPicUrl($postObj->_PicUrl);
        if(isset($postObj->_MediaId)) $this->setMediaId($postObj->_MediaId);
        if(isset($postObj->_Format)) $this->setFormat($postObj->_Format);
        if(isset($postObj->_Recognition)) $this->setRecognition($postObj->_Recognition);
        if(isset($postObj->_ThumbMediaId)) $this->setThumbMediaId($postObj->_ThumbMediaId);
    }
    
    static public function getChat($postObj){
        //判断$instance是否是Uni的对象
        //没有则创建
        if (!self::$chat instanceof self) {
           
            self::$chat = new self($postObj);
            $a = json_encode($postObj);
            file_put_contents('/tmp/test.log', $a);
        }
        return self::$chat;
    }
            
    
    
    
    private function setToUserName($toUserName){
        $this->_ToUserName = $toUserName;
    }
    
    private function setFromUserName($fromUserName){
        $this->_FromUserName = $fromUserName;
    }
    
    private function setCreateTime($createTime){
        $this->_CreateTime = $createTime;
    }
    
    private function setMsgType($msgType){
        $this->_MsgType = $msgType;
    }
    
    private function setContent($content){
        $this->_Content = $content;
    }
    
    private function setMsgId($msgId){
        $this->_MsgId = $msgId;
    }
    
    private function setPicUrl($picUrl){
        $this->_PicUrl = $picUrl;
    }
    
    private function setMediaId($mediaId){
        $this->_MediaId = $mediaId;
    }
    
    private function setFormat($format){
        $this->_Format = $format;
    }
    
    private function setRecognition($recognition){
        $this->_Recognition = $recognition;
    }
    
    private function setThumbMediaId($thumbMediaId){
        $this->_ThumbMediaId = $thumbMediaId;
    }
    
    public function getFromUserName(){
        return $this->_FromUserName;
    }
    
    public function getToUserName(){
        return $this->_ToUserName;
    }
    
    public function response(response $response){
        file_put_contents('/tmp/a.text', json_encode(self::$chat));
        $responseJson = $response->mian(self::$chat);
    }
}






