<?php
class Router
{

    static function initialize(array $routeEndpoints, string $defaultEndpoint): void
    {

        $uri = parse_url($_SERVER['REQUEST_URI'])["path"];
        //%s = string
        $pathFormat = __DIR__ . '/../views/%s.php';

        if ($uri == '/') {
            require(sprintf($pathFormat, $defaultEndpoint));
            return;
        }

        foreach ($routeEndpoints as $routeEndpoint) {
            if ($uri == '/' . $routeEndpoint) {
                require(sprintf($pathFormat, $routeEndpoint));
                break;
            }
        }
    }
}
