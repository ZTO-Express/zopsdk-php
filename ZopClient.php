<?php


namespace zop;
use function PHPSTORM_META\type;

class ZopClient
{
    private $zopProperties;

    /**
     * ZopClient constructor.
     * @param $zopProperties
     */
    public function __construct($zopProperties)
    {
        $this->zopProperties = $zopProperties;
    }

    public function execute($zopRequest)
    {
        $url = $zopRequest.url;
        $params = $zopRequest.getParams();
        $fixedParams = Array();
        foreach ($params as $k => $v) {
            if (gettype($v) != "string") {
                $fixedParams += [$k => json_encode($v)];
            } else {
                $fixedParams += [$k => $v];
            }
        }


        $str_to_digest = "";
        foreach ($fixedParams as $k => $v) {
            $str_to_digest = $str_to_digest.$k."=".$v."&";
        }

        $str_to_digest = substr($str_to_digest, 0, -1).$this->zopProperties.getKey();
        $data_digest = base64_encode(md5($str_to_digest, TRUE));
        $headers = "Content-Type: application/x-www-form-urlencoded; charset=UTF-8\r\n" .
            "x-companyid: ".$this->zopProperties.getCompanyid()."\r\n" .
            "x-datadigest: ".$data_digest;
       return ZopHttpUtil::post($url, $headers, http_build_query($fixedParams), 2000);
    }
}