<?php
class tool{
    
    public static function analysis($sign){
        $content = self::curl_recieve_sign($sign);
        if(preg_match("##is", $content, $info)){
            $tb_item_id = $info[1];
            return $tb_item_id;
        }
    }
    
    
    
    public static function curl_recieve_sign($content){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $content);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_HEADER,0);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    
    
    
}
