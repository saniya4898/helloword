<?php

class Bootstrap extends Yaf_Bootstrap_Abstract
{

    public function _init(Yaf_Dispatcher $dispatcher)
    {
        // auto start session
        Yaf_Session::getInstance()->start();
        
        // auto load config data
        $config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('GlobalConfig', $config);
        
        //auto load redis
        $redis = new Redis();
        $redis->connect($config->redis->host, $config->redis->port, $config->redis->timeout, $config->redis->reserved, $config->redis->interval);
        Yaf_Registry::set('redis', $redis);
        
        //auto load mysql
        Yaf_Registry::set('dbRead', new Db ( 'mysql:host=' . $config->mysql->read->host . ';dbname=' . $config->mysql->read->dbname . ';charset=' . $config->mysql->read->charset . ';port=' . $config->mysql->read->port . '', $config->mysql->read->username, $config->mysql->read->password));
        Yaf_Registry::set('dbWrite', new Db ( 'mysql:host=' . $config->mysql->write->host . ';dbname=' . $config->mysql->write->dbname . ';charset=' . $config->mysql->write->charset . ';port=' . $config->mysql->write->port . '', $config->mysql->write->username, $config->mysql->write->password));
        
        // auto load global model
        Yaf_Registry::set('model', new model());
        
        // auto load global plugin
        $dispatcher->registerPlugin(new plugin());
        
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
