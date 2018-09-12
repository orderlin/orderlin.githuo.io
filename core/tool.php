<?php
namespace linerCore;
use linerCore\tpInterface;

class tool{
    
    public static function analysisShotUrl($sign){
        $content = self::curlAnalysisShotUrl(tpInterface::analysisShotUrlApi, $sign);
        if(preg_match("#.*?item.taobao.com.*?id=(\d+)#isu", $content, $info)){
            $tb_item_id = $info[1];
            return "宝贝关注成功,您的宝贝会每天监控一次价格信息变动,2天以上会绘制成图表,请注意观察(回复'宝贝曲线图获得'获取变动图)";
        }else{
            return 'id匹配失败'.$content;
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
