<?php
namespace linerCore;
use linerCore\tpInterface;

class tool{
    
    public static function analysisShotUrl($sign){
        $content = self::curlAnalysisShotUrl(tpInterface::analysisShotUrlApi, $sign);
        //return $content;
        if(preg_match("#.*?item.taobao.com.*?id=(\d+)#isu", $content, $info)){
            $tb_item_id = $info[1];
            return '宝贝加入成功,回复\<曲线图\>查看价格曲线图,2天后才会出图';
        }else{
            return '1';
        }
    }
    
    
    
    public static function curlAnalysisShotUrl($url, $sign){
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        
        curl_setopt($curl, CURLOPT_HEADER, 0);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($curl, CURLOPT_POST, 1);
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, $sign);
        
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        
        $data = curl_exec($curl);
        
        curl_close($curl);
        
        return $data;
    }
    
    
}
