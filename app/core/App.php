<?php

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // Store controller name before instantiation
        $controllerName = $this->controller;

        // Check if controller exists
        if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $this->controller = $controllerName;
            unset($url[0]);
        }

        // Require controller file
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Check if method exists
        if (isset($url[1])) {
            // Check if this is admin panel for composite routes
            $isAdmin = (strtolower($controllerName) === 'admincontroller');
            
            if ($isAdmin && isset($url[2])) {
                // For admin panel, support nested routes like admin/projects/create
                // Convert to method name: projects_create
                $compositeMethod = $url[1] . '_' . $url[2];
                if (method_exists($this->controller, $compositeMethod)) {
                    $this->method = $compositeMethod;
                    unset($url[1]);
                    unset($url[2]);
                } else {
                    // If composite method doesn't exist, try normal method
                    if (method_exists($this->controller, $url[1])) {
                        $this->method = $url[1];
                        unset($url[1]);
                    }
                }
            } else {
                // Normal route: controller/method
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
        }

        // Get remaining params
        $this->params = $url ? array_values($url) : [];

        // Call controller method with params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}
