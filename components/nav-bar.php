<?php

require_once(__DIR__ . '/component.php');


class Page
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

    const OPT_KEY_PAGES = "pages";

    public array $pages = [];

    public function __construct(array $pages)
    {
        $this->pages = $pages;
    }

    public function getAllOptions(): array
    {
        return [self::OPT_KEY_PAGES => $this->pages];
    }
}

class NavBarComponent implements IComponent
{

    function render(IComponentOptions $options)
    {

        $pages = $options->getAllOptions()[NavBarOptions::OPT_KEY_PAGES];

        echo '<nav class="main-nav">';
        foreach ($pages as $page) {
            echo '<a href="' . $page->path . '" class="nav-link">' . $page->name . '</a>';
        }
        echo '</nav>';
    }
}
