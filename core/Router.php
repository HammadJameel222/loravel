<?php

namespace app\core;

class Router
{

    protected array $routes = [];
    protected Request $request;
    protected Response $response;

    function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        // $this->request = new Request();   
        // $this->response = new Response();
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            exit;
        }
        if (is_string($callback)) {
            // Assuming the callback is a view name, render the view
            // ob_start();
            // include_once __DIR__ . '/../views/' . $callback . '.php';
            // return ob_get_clean();
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    function renderView($view)
    {
        $layout = $this->layoutView();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{ content }}', $viewContent, $layout);

        // include_once Application::$ROOT_DIR."/views/$view.php";
    }

    protected function layoutView()
    {
        // ob_start();
        // include_once __DIR__ . '/../views/layout/main.php';
        // return ob_get_clean();
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layout/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
