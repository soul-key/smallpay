<?php

namespace SmallPay\library;

class Tools
{
    /**
     * 发送curl，post请求
     * @param $url
     * @param array $data
     * @return bool|string
     */
    public static function curlPost($url, array $data)
    {
        $postdata = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * 生成签名
     * @param array $params
     * @param string $secret
     * @return string
     */
    public static function Sign(array $params, string $secret)
    {
        ksort($params);
        $str = array();
        foreach ($params as $key => $value) {
            if ($key != "sign" && $value != "") {
                $str[] = $key . "=" . $value;
            }
        }
        return md5(implode("&", $str) . "&key=" . $secret);
    }
}