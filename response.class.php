<?php
class response{
      private $text = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[%s]]></MsgType>
      <Content><![CDATA[%s]]></Content>
      <FuncFlag>0</FuncFlag>
      </xml>";
      
      
      private $img = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[%s]]></MsgType>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <MediaId><![CDATA[%s]]></MediaId>
      </xml>";
    
  /*
   * text走正则,判断是否是口令或者是菜单关键词
   * 其它走图灵API,自动回复图片等信息
   */
    public function main($chat){

        switch ($chat->_MsgType){
            
            case 'text':
                $this->dealText($chat);
                break;
            case 'image':
                $this->dealImg($chat);
                break;
            default :
                echo '无法识别';
                
        }
        
        
        
        
    }
    
    private function dealText($chat){
        
        $content = '111';
        if(preg_match("#菜单#is", $chat->_Content)){
            $content = '菜单';
        }
        echo sprintf($this->text, $chat->_ToUserName, $chat->_FromUserName, time(), $chat->_MsgType, $content);
    } 
    
    private function dealImg($chat){
        $content = '222';
        echo sprintf($this->text, $chat->_ToUserName, $chat->_FromUserName, time(), $chat->_MsgType, $content);
        //echo sprintf($this->text, $chat->_ToUserName, $chat->_FromUserName, time(), $chat->_MsgType, $chat->_PicUrl, $chat->_MediaId);
    } 
    
    
    
    
}