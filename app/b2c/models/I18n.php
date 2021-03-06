<?php

class I18nModel
{

    private $redis;

    private $app;

    private $lang;

    private $key;

    private $fieldMd5;

    public function __construct($redis, $app, $lang)
    {
        $this->redis = $redis;
        $this->app = $app;
        $this->lang = $lang;
    }

    public function get($module, $field, array $value = array())
    {
        $this->key = $this->app . ':lang:' . $this->lang . ':' . $module;
        $this->fieldMd5 = md5($field);
        
        if ($this->exists($this->key, $this->fieldMd5)) {
            return strtr($this->redis->hget($this->key, $this->fieldMd5), $value);
        }
        
        $this->add($this->key, $this->fieldMd5, $field);
        return strtr($field, $value);
    }

    public function add($key, $fieldMd5, $field)
    {
        return $this->redis->hset($key, $fieldMd5, $field);
    }

    public function exists($key, $fieldMd5)
    {
        return $this->redis->hexists($key, $fieldMd5);
    }

    public function delete($key, $fieldMd5)
    {
        return $this->redis->hdel($key, $fieldMd5);
    }
}
