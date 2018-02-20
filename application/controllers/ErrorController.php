<?php

class ErrorController extends Application_Controller_Cli
{
    public function errorAction ()
    {
        $error_handler = $this->_getParam ('error_handler');
        echo "Error code: ", $error_handler ['type'], PHP_EOL;
        $exception = $error_handler ['exception'];
        echo $exception->getMessage (), PHP_EOL;
    }
}