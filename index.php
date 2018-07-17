<?php
define("TOKEN", "linerShow");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->getRes();
class wechatCallbackapiTest
{
    //    function responseMsg()
    public function getRes(){
                $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
                if (!empty($postStr)){
                        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                        $fromUsername = $postObj->FromUserName;
                        $toUsername = $postObj->ToUserName;
                        $keyword = trim($postObj->Content);
                        $time = time();
                        $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
                        if($keyword == "?")
                            {
                                    $msgType = "text";
                                    $contentStr = date("Y-m-d H:i:s",time());
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                    echo $resultStr;
                                }
                            }else{
                                    echo "";
                                    exit;
                                }
                            }
}
?>
