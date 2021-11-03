<?php
class BaseController {

    protected $viewPath = '';
    protected $method = 'index';
    protected $viewParams = [];
    
    public function __construct(){
        if ( ! $this->viewPath ) { 
            $classname = get_class($this);
            $this->viewPath = str_replace('controller', '', strtolower($classname) );
        };
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, $method))
        {
            $this->method = $method;
        }
        else {
            array_unshift($arguments[0], $method);
        }
        return call_user_func_array([$this, $this->method], $arguments);
    }

    protected function loadView ($view = '') {
        if ( ! $view ) {
            //default load a view with the same name as the method
            $view = $this->method;
        }
        
        //maakt variabelen van een array
        extract($this->viewParams);
        
        include BASE_DIR . "/views/" . $this->viewPath . "/$view.php";
    }

    public function redirect($url, $code = null) {
        header("Location: " . $url, true, $code);
        exit();
    }
}