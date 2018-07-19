<?php
define("TOKEN", "linerShow");

if (isset($_GET['echostr'])) {
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
    $postArray = $_REQUEST;
    file_put_contents('/tmp/test.txt', json_encode($postArray));
}


?>
