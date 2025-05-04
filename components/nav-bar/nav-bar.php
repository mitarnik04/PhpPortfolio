<?php

require_once __DIR__ . '/../component.php';
require_once __DIR__ . '/assets/page.php';

class NavBarOptions implements IComponentOptions
{

    const OPT_KEY_PAGES = "pages";

    /**
     * @var Page[] Pages used to build the navigation (path → href)
     */
    private array $pages = [];

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


        /** @var Page[] $pages */
        $pages = $options->getAllOptions()[NavBarOptions::OPT_KEY_PAGES];

        usort($pages, function ($left, $right) {
            return ($left->options->order ?? PHP_INT_MAX) <=> ($right->options->order ?? PHP_INT_MAX);
        });
?>
        <nav class="main-nav">
            <?php foreach ($pages as $page): ?>
                <a href="<?= $page->path ?>" class="nav-link">
                    <?php
                    $materialIconName = $page->options->materialIconName ?? '';
                    if (!empty($materialIconName)): ?>
                        <span class="material-icons" aria-hidden="true"><?= htmlspecialchars($materialIconName) ?></span>
                    <?php endif; ?>

                    <span class="link-text"><?= $page->label ?></span>
                </a>
            <?php endforeach; ?>
        </nav>
<?php
    }
}
