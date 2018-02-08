<?php

class Container
{

    private static $instance = null;

    private $hashMap = [];

    private $cacheMap = [];

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * @param $key string
     * @param $value callable|string
     */
    public function bind($key, $value)
    {
        $this->hashMap[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getObject($key)
    {
        if (isset($this->cacheMap[$key])) {
            return $this->cacheMap[$key];
        }

        $value = $this->hashMap[$key];

        if (is_callable($value)) {
            $this->cacheMap[$key] = $value();

            return $this->cacheMap[$key];
        } else {
            $this->cacheMap[$key] = new $value();

            return new $value();
        }
    }
}