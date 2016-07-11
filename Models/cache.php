<?php
/**
 * Created by PhpStorm.
 * User: Mandeep Singh
 * Date: 11/07/2016
 * Time: 20:14
 */

class cache
{
    private $cache;
    private $mem;
    private $key;

    /**
     * @return Memcached
     */
    public function getMem()
    {
        return $this->mem;
    }

    /**
     * @param Memcached $mem
     */
    public function setMem($mem)
    {
        $this->mem = $mem;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * cache constructor.
     */
    public function __construct()
    {
        $this->mem = new Memcached();
        $this->mem->addServer("127.0.0.1", 11211);
        //$memKey = $picPath . $width . $height;
    }

    public function getByKey()
    {
        return $this->mem->get($this->key);
    }

    public function setCache($data)
    {
        $this->mem->set($this->key, base64_encode($data));
    }
}