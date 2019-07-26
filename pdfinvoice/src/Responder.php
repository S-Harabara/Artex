<?php

namespace PdfInvoice;

use PdfInvoice\Route\IRoute;
use PdfInvoice\Route\Sandbox;
use PdfInvoice\Route\Worker;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Responder
{
    /**
     * @var string $route
     */
    private $route;

    /**
     * @var array $routes
     */
    private static $routes = [
        'sandbox' => Sandbox::class,
        'worker' => Worker::class
    ];

    /**
     * Responder constructor.
     */
    public function __construct()
    {
        $this->route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "\ \t\n\r\0\x0B\/");
    }

    /**
     * @return void
     */
    public function dispatch(): void
    {
        $route = $this->processRoute($this->route);
        if (!empty($route[0]) && isset(self::$routes[$route[0]])) {
            $routeClass = self::$routes[$route[0]];
            /** @var IRoute $controller */
            $controller = new $routeClass($route);
            if($controller instanceof IRoute) {
                $response = $controller->renderPage(Request::createFromGlobals());
                echo $response->send();
                return;
            }
        }
        echo (new Response('Page not found', 404))->send();
    }

    /**
     * @param string $route
     * @return array
     */
    private function processRoute(string $route): array
    {
        $route = explode('/', $route);
        unset($route[0]);
        return array_values($route);
    }
}
