<?php

require_once DIR_COMPONENTS . '/component.php';
require_once __DIR__ . '/assets/page.php';

class NavBarOptions implements IComponentOptions
{

    /** @param array<Page> $pages */
    public function __construct(
        private string $currentPath,
        private array $pages = [],
    ) {}

    /** @return array<Page> */
    public function getPages(): array
    {
        return $this->pages;
    }

    public function getCurrentPath(): string
    {
        return $this->currentPath;
    }
}

class NavBarComponent implements IComponent
{

    /** @param NavBarOptions $options */
    function render(IComponentOptions $options): void
    {
        if (!($options instanceof NavBarOptions)) {
            throw new InvalidArgumentException('NavBarComponent expects an instance of NavBarOptions.');
        }

        $pages = $options->getPages();
        $currentPath = $options->getCurrentPath();

        usort($pages, function ($left, $right) {
            return ($left->options->order ?? PHP_INT_MAX) <=> ($right->options->order ?? PHP_INT_MAX);
        });
?>
        <nav class="flex f-c-c f-w main-nav">
            <?php foreach ($pages as $page):
                $isCurrentlyActive =  $page->path == $currentPath;
            ?>
                <a href="<?= $page->path ?>" class="flex f-ai-c f-g-6px nav-link <?= $isCurrentlyActive ? 'active' : '' ?>">
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
