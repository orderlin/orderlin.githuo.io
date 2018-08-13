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
      
      
      private $image = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[%s]]></MsgType>
      <Image>
      <MediaId><![CDATA[%s]]></MediaId>
      </Image>
      <FuncFlag>0</FuncFlag>
      </xml>";
    
      private $voice = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[%s]]></MsgType>
      <Voice>
      <MediaId>
      <![CDATA[%s]]>
      </MediaId>
      </Voice>
      <FuncFlag>0</FuncFlag>
      </xml>";
      
      private $video = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[%s]]></MsgType>
      <Video>
      <MediaId><![CDATA[%s]]></MediaId>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      </Video> 
      <FuncFlag>0</FuncFlag>
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
            case 'voice':
                $this->dealVoice($chat);
                break;
            case 'video':
                $this->dealVideo($chat);
                break;
            default :
                echo sprintf($this->text, $chat->_ToUserName, $chat->_FromUserName, time(), 'text', '对不起,无法识别您发送的消息');
                
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
        //echo sprintf($this->text, $chat->_ToUserName, $chat->_FromUserName, time(), 'text', $content);
        echo sprintf($this->image, $chat->_ToUserName, $chat->_FromUserName, time(), $chat->_MsgType, $chat->_MediaId);
    } 
    
    
    private function dealVoice($chat){
        echo sprintf($this->voice, $chat->_ToUserName, $chat->_FromUserName, time(), $chat->_MsgType, $chat->_MediaId);
    } 
    
    private function dealVideo($chat){
        $title = 'video test';
        $description = '部落永不为奴,除非包吃包住!';
        //echo sprintf($this->text, $chat->_ToUserName, $chat->_FromUserName, time(), 'text', $description);
        echo sprintf($this->video, $chat->_ToUserName, $chat->_FromUserName, time(), $chat->_MsgType, $chat->_ThumbMediaId, $title, $description);
    } 
    
}