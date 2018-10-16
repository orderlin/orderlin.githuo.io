<?php
namespace linerCore;
use linerCore\tpInterface;
use linerController\folder;
use linerController\checkItem;

class tool{
    
    public static function analysisShotUrl($sign){
        $content = self::curlAnalysisShotUrl(tpInterface::analysisShotUrlApi, $sign);
        if(preg_match("#.*?item.taobao.com.*?id=(\d+)#isu", $content, $info)){
            $tb_item_id = $info[1];
            $b2c = 1;
            $folderObject = new folder(123);
            var_dump($folderObject);
            exit;
            return json_encode($folderObject);
            $informalFolder = $folderObject->getInformal();
            $result = checkItem::insertCheckItem($informalFolder, $b2c, $tb_item_id);
            if($result){
                return 'item ready to check !';
            }else{
                return 'add item failed, plase check your short link !';
            }
            
        }else{
            return 'add item failed, plase check your short link !';
        }
    }
    
    
    
    public static function curlAnalysisShotUrl($url, $sign){
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        
        curl_setopt($curl, CURLOPT_HEADER, 0);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($curl, CURLOPT_REFERER, 'http://www.xuandan.com/tools.html');
        
        curl_setopt($curl, CURLOPT_POST, 1);
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, $sign);
        
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        
        $data = curl_exec($curl);
        
        curl_close($curl);
        
        return $data;
    }
    
    
}
