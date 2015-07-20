<?php

class IndexController extends Yaf_Controller_Abstract
{

    public function init()
    {
        
    }

    public function indexAction()
    {
		var_dump(Header::getList());
        $this->_view->word = "hello world";
    }
}
