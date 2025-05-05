<?php
class Router
{

    /** @var array<string> $routeEndpoints */
    private array $routeEndpoints;

    private string $defaultEndpoint;

    private function __construct(array $routeEndpoints, string $defaultEndpoint)
    {
        $this->routeEndpoints = $routeEndpoints;
        $this->defaultEndpoint = $defaultEndpoint;
    }

    /**
     * @param array<string> $routeEndpoints    List of valid route names (e.g., ['about', 'contact'])
     * @param string   $defaultEndpoint   Fallback route to use for root path ('/')
     */
    public static function initialize(array $routeEndpoints, string $defaultEndpoint): Router
    {
        return new Router($routeEndpoints, $defaultEndpoint);
    }

    public function route(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])["path"];
        //%s = string
        $pathFormat = __DIR__ . '/../views/%s.php';

        if ($uri == '/') {
            require sprintf($pathFormat, $this->defaultEndpoint);
            return;
        }

        foreach ($this->routeEndpoints as $routeEndpoint) {
            if ($uri == '/' . $routeEndpoint) {
                require(sprintf($pathFormat, $routeEndpoint));
                break;
            }
        }
    }
}
