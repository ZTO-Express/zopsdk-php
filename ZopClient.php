<?php


namespace zop;
include "ZopHttpUtil.php";

class ZopClient
{
    private $zopProperties;

    private $httpClient;
    /**
     * ZopClient constructor.
     * @param $zopProperties
     */
    public function __construct($zopProperties)
    {
        $this->zopProperties = $zopProperties;
        $this->httpClient = new ZopHttpUtil();
    }

    public function execute($zopRequest)
    {
        $url = $zopRequest->getUrl();
        $params = $zopRequest->getParams();
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

        $str_to_digest = substr($str_to_digest, 0, -1).$this->zopProperties->getKey();
        $data_digest = base64_encode(md5($str_to_digest, TRUE));
        $headers = Array(
            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
            "x-companyid: ".$this->zopProperties->getCompanyid(),
            "x-datadigest: ".$data_digest
        );

        return $this->httpClient->post($url, $headers, http_build_query($fixedParams), 2000);
    }
}