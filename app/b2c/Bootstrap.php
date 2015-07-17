<?php

class Bootstrap extends Yaf_Bootstrap_Abstract
{

    public function _init(Yaf_Dispatcher $dispatcher)
    {
        // auto start session
        Yaf_Session::getInstance()->start();
        
        // auto load config data
        Yaf_Registry::set('GlobalConfig', Yaf_Application::app()->getConfig());
        
        // auto load global model
        Yaf_Registry::set('GlobalModel', new GlobalModel());
        
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
