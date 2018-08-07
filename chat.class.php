<?php

class chat
{

    public $_ToUserName;

    public $_FromUserName;

    public $_CreateTime;

    public $_MsgType;

    public $_Content;

    public $_MsgId;

    public $_PicUrl;

    public $_MediaId;

    public $_Format;

    public $_Recognition;

    public $_ThumbMediaId;

    /*
     * api_type 决定是否开启API对话
     */
    private $_API_TYPE = 0;

    /*
     * 构造函数填充基础属性
     */
    public function __construct($postObj)
    {
        if (isset($postObj->FromUserName))
            $this->setToUserName($postObj->FromUserName);
        if (isset($postObj->ToUserName))
            $this->setFromUserName($postObj->ToUserName);
        if (isset($postObj->CreateTime))
            $this->setCreateTime($postObj->CreateTime);
        if (isset($postObj->MsgType))
            $this->setMsgType($postObj->MsgType);
        if (isset($postObj->Content))
            $this->setContent($postObj->Content);
        if (isset($postObj->MsgId))
            $this->setMsgId($postObj->MsgId);
        if (isset($postObj->PicUrl))
            $this->setPicUrl($postObj->PicUrl);
        if (isset($postObj->MediaId))
            $this->setMediaId($postObj->MediaId);
        if (isset($postObj->Format))
            $this->setFormat($postObj->Format);
        if (isset($postObj->Recognition))
            $this->setRecognition($postObj->Recognition);
        if (isset($postObj->ThumbMediaId))
            $this->setThumbMediaId($postObj->ThumbMediaId);
    }


    private function setToUserName($toUserName)
    {
        $this->_ToUserName = $toUserName;
    }

    private function setFromUserName($fromUserName)
    {
        $this->_FromUserName = $fromUserName;
    }

    private function setCreateTime($createTime)
    {
        $this->_CreateTime = $createTime;
    }

    private function setMsgType($msgType)
    {
        $this->_MsgType = $msgType;
    }

    private function setContent($content)
    {
        $this->_Content = $content;
    }

    private function setMsgId($msgId)
    {
        $this->_MsgId = $msgId;
    }

    private function setPicUrl($picUrl)
    {
        $this->_PicUrl = $picUrl;
    }

    private function setMediaId($mediaId)
    {
        $this->_MediaId = $mediaId;
    }

    private function setFormat($format)
    {
        $this->_Format = $format;
    }

    private function setRecognition($recognition)
    {
        $this->_Recognition = $recognition;
    }

    private function setThumbMediaId($thumbMediaId)
    {
        $this->_ThumbMediaId = $thumbMediaId;
    }

    public function getFromUserName()
    {
        return $this->_FromUserName;
    }

    public function getToUserName()
    {
        return $this->_ToUserName;
    }

    /* public function response(response $response)
    {
        file_put_contents('/tmp/a.text', json_encode(self::$chat));
        $responseJson = $response->mian(self::$chat);
    } */
}






