<?php
define("TOKEN", "linerShow");

if (isset($_GET)) {
    // 验证服务器
    $nonce = $_GET['nonce'];
    $timestamp = $_GET['timestamp'];
    $echostr = $_GET['echostr'];
    $signature = $_GET['signature'];
    // 形成数组，然后按字典序排序
    $array = array();
    $array = array(
        $nonce,
        $timestamp,
        TOKEN
    );
    sort($array);
    // 拼接成字符串,sha1加密 ，然后与signature进行校验
    $str = sha1(implode($array));
    if ($str == $signature && $echostr) {
        // 第一次接入weixin api接口的时候
        echo $echostr;
        exit();
    }
} else {
    $wechatObj = new wechatCallbackapiTest();
    $wechatObj->getRes();
}

class wechatCallbackapiTest
{

    //     function responseMsg()
    public function getRes()
    {
               /*  $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
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
                                $contentStr = date("Y-m-d H:i:s", time());
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                            }
                        }else{
                                echo "";
                                exit();
                        }
                  } */
                
      }
}
?>
