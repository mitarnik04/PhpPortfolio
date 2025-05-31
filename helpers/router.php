<?php
class Router
{

    /** 
     * @param array<string> $routeEndpoints
     * @param callable(string $pageName): string $getFullPagePath 
     * */
    private function __construct(
        private array $routeEndpoints,
        private string $defaultEndpoint,
        private $getFullPagePath
    ) {}

    /**
     * @param array<string> $routeEndpoints    List of valid route names (e.g., ['about', 'contact'])
     * @param string   $defaultEndpoint   Fallback route to use for root path ('/')
     */
    public static function initialize(array $routeEndpoints, string $defaultEndpoint, callable $getFullPagePath): Router
    {
        return new Router($routeEndpoints, $defaultEndpoint, $getFullPagePath);
    }

    public function getCurrentPath()
    {
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return $urlPath === '/'
            ? '/' . $this->defaultEndpoint
            : $urlPath;
    }

    public function route(array $variables = []): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($uri === '/') {
            extract($variables);
            require ($this->getFullPagePath)($this->defaultEndpoint);
            return;
        }

        foreach ($this->routeEndpoints as $routeEndpoint) {
            if ($uri === '/' . $routeEndpoint) {
                extract($variables);
                require ($this->getFullPagePath)($routeEndpoint);
                break;
            }
        }
    }
}
