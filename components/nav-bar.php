<?php

require_once(__DIR__ . '/component.php');


class Path
{
    public string $path;
    public string $name;

    public function __construct(string $path, string $name)
    {
        $this->path = $path;
        $this->name = $name;
    }
}


class NavBarOptions implements IComponentOptions
{
    public array $paths = [];

    public function __construct(array $paths)
    {
        $this->paths = $paths;
    }

    public function getAllOptions(): array
    {
        return ['paths' => $this->paths];
    }
}

class NavBarComponent implements IComponent
{

    function render(IComponentOptions $options)
    {

        $paths = $options->getAllOptions()['paths'];

        echo '<nav class="main-nav">';
        foreach ($paths as $path) {
            echo '<a href="' . $path->path . '" class="nav-link">' . $path->name . '</a>';
        }
        echo '</nav>';
    }
}
