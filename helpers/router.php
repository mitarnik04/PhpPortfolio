<?php
class Router
{

    /**
     * Initializes routing by resolving the current URI to a view file.
     *
     * @param string[] $routeEndpoints    List of valid route names (e.g., ['about', 'contact'])
     * @param string   $defaultEndpoint   Fallback route to use for root path ('/')
     */
    static function initialize(array $routeEndpoints, string $defaultEndpoint): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])["path"];
        //%s = string
        $pathFormat = __DIR__ . '/../views/%s.php';

        if ($uri == '/') {
            require sprintf($pathFormat, $defaultEndpoint);
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
