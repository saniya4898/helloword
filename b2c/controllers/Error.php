<?php

class ErrorController extends Yaf_Controller_Abstract
{

    public function errorAction($exception)
    {
        $this->_view->exception = $exception;
    }
}