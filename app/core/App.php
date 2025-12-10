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

        // Check for admin panel first (special case)
        if (isset($url[0]) && strtolower($url[0]) === 'admin') {
            $controllerName = 'AdminController';
            $this->controller = $controllerName;
            array_shift($url); // Remove 'admin' from URL
        }
        // Check if controller exists
        elseif (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $this->controller = $controllerName;
            array_shift($url); // Remove controller from URL
        }

        // Require controller file
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Check if method exists
        if (isset($url[0])) {
            // Check if this is admin panel for composite routes
            $isAdmin = (strtolower($controllerName) === 'admincontroller');
            
            if ($isAdmin && isset($url[1])) {
                // For admin panel, support nested routes like admin/projects/create
                // Convert to method name: projects_create
                $compositeMethod = $url[0] . '_' . $url[1];
                
                if (method_exists($this->controller, $compositeMethod)) {
                    $this->method = $compositeMethod;
                    array_shift($url); // Remove resource
                    array_shift($url); // Remove action
                } else {
                    // Also try camelCase version: createPublication
                    $camelCaseMethod = $url[1] . ucfirst(rtrim($url[0], 's'));
                    if (method_exists($this->controller, $camelCaseMethod)) {
                        $this->method = $camelCaseMethod;
                        array_shift($url); // Remove resource
                        array_shift($url); // Remove action
                    } else {
                        // If composite method doesn't exist, try normal method on url[1]
                        if (method_exists($this->controller, $url[1])) {
                            $this->method = $url[1];
                            array_shift($url); // Remove resource
                            array_shift($url); // Remove action
                        } else {
                            // Last resort: try url[0] as method
                            if (method_exists($this->controller, $url[0])) {
                                $this->method = $url[0];
                                array_shift($url); // Remove method
                            }
                        }
                    }
                }
            } else {
                // Normal route: controller/method
                if (method_exists($this->controller, $url[0])) {
                    $this->method = $url[0];
                    array_shift($url); // Remove method
                }
            }
        }

        // Get remaining params (url is already clean from array_shift)
        $this->params = $url ? $url : [];

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
