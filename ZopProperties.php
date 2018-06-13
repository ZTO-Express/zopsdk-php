<?php
/**
 * Created by PhpStorm.
 * User: choco
 * Date: 6/13/18
 * Time: 5:47 PM
 */
namespace zop;


class ZopProperties
{
    private $companyid;
    private $key;

    /**
     * ZopProperties constructor.
     * @param $companyid
     * @param $key
     */
    public function __construct($companyid, $key)
    {
        $this->companyid = $companyid;
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getCompanyid()
    {
        return $this->companyid;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }




}