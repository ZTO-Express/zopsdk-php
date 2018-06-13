<?php

namespace zop;


class ZopRequest
{
    private $url;
    private $params = Array();

    public function addParam($k,$v){
        $this->params += [$k=>$v];
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }



    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }



}