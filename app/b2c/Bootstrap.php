<?php

class Bootstrap extends Yaf_Bootstrap_Abstract
{
    private $config;
    public function _init(Yaf_Dispatcher $dispatcher)
    {
        // auto start session
        Yaf_Session::getInstance()->start();
        
        // auto load config data
        $this->config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('config', $this->config);
        
        //auto load redis
        $redis = new Redis();
        $redis->connect($this->config->redis->host, $this->config->redis->port, $this->config->redis->timeout, $this->config->redis->reserved, $this->config->redis->interval);
        Yaf_Registry::set('redis', $redis);
        
        //auto load mysql
        Yaf_Registry::set('dbRead', new Db ( 'mysql:host=' . $this->config->mysql->read->host . ';dbname=' . $this->config->mysql->read->dbname . ';charset=' . $this->config->mysql->read->charset . ';port=' . $this->config->mysql->read->port . '', $this->config->mysql->read->username, $this->config->mysql->read->password));
        Yaf_Registry::set('dbWrite', new Db ( 'mysql:host=' . $this->config->mysql->write->host . ';dbname=' . $this->config->mysql->write->dbname . ';charset=' . $this->config->mysql->write->charset . ';port=' . $this->config->mysql->write->port . '', $this->config->mysql->write->username, $this->config->mysql->write->password));
        
        // auto load global model
        Yaf_Registry::set('model', new GlobalModel());
        
        // auto load global plugin
        $dispatcher->registerPlugin(new GlobalPlugin());
        
        // auto save request
        $request = $dispatcher->getRequest();
        
        // auto set ajax is no render
        if ($request->isXmlHttpRequest()) {
            $dispatcher->autoRender(false);
        }
        
        // auto set http protocol to action except http get protocol
        if (! $request->isGet()) {
            $dispatcher->setDefaultAction($request->getMethod());
        }
    }
}
