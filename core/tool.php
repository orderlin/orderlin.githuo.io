<?php
namespace linerCore;
use linerCore\tpInterface;

class tool{
    
    public static function analysisShotUrl($sign){
        $content = self::curlAnalysisShotUrl(tpInterface::analysisShotUrlApi, $sign);
        if(preg_match("#.*?item.taobao.com.*?id=(\d+)#isu", $content, $info)){
            $tb_item_id = $info[1];
            return "������ע�ɹ�,���ı�����ÿ����һ�μ۸���Ϣ�䶯,2�����ϻ���Ƴ�ͼ��,��ע��۲�(�ظ�'��������ͼ���'��ȡ�䶯ͼ)";
        }else{
            return 'idƥ��ʧ��'.$content;
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
