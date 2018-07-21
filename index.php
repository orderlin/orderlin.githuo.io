<?php
define("TOKEN", "linerShow");


// 验证服务器
$nonce = isset($_GET['nonce']) ? $_GET['nonce'] : '';
$timestamp = isset($_GET['timestamp']) ? $_GET['timestamp'] : '';
$echostr = isset($_GET['echostr']) ? $_GET['echostr'] : '';
$signature = isset($_GET['signature']) ? $_GET['signature'] : '';
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
/*
 * 第一次接入验证
 */
if (isset($_GET['echostr'])) {
    if ($str == $signature && $echostr) {
        // 第一次接入weixin api接口的3时候
        echo $echostr;
        exit();
    }
} else {
    $postArray = file_get_contents('php://input');
    file_put_contents('/tmp/test.txt', json_encode($postArray));
}


?>
