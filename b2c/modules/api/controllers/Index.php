<?php

class IndexController extends Yaf_Controller_Abstract
{

    public function indexAction()
    {
        $this->_view->test = 'api/index/index/';
    }
}