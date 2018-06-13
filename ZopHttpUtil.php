<?php
/**
 * Created by PhpStorm.
 * User: choco
 * Date: 6/13/18
 * Time: 5:54 PM
 */

namespace zop;

class ZopHttpUtil
{
    public static function post($url, $headers, $querystring, $timeout)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);//设置链接
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);//设置HTTP头
        curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $querystring);
        $response = curl_exec($ch);
        return $response;
    }

}