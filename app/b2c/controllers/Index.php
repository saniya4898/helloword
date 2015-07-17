<?php

class IndexController extends Yaf_Controller_Abstract
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        $this->_view->word = "hello world";
    }
}
