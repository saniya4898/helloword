<?php

class CacheModel
{

    private $redis;

    private $app;

    public function __construct($redis, $app)
    {
        $this->redis = $redis;
        $this->app = $app;
    }
}
