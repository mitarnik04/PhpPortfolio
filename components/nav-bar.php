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

    /**
     * @var Page[] Pages used to build the navigation (path → href, name → label)
     */
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

    /**
     * @param NavBarOptions $options
     */
    function render(IComponentOptions $options): void
    {
        if (!($options instanceof NavBarOptions)) {
            throw new InvalidArgumentException('NavBarComponent expects an instance of NavBarOptions.');
        }


        $pages = $options->getAllOptions()[NavBarOptions::OPT_KEY_PAGES];

        echo '<nav class="main-nav">';
        foreach ($pages as $page) {
            echo '<a href="' . $page->path . '" class="nav-link">' . $page->name . '</a>';
        }
        echo '</nav>';
    }
}
