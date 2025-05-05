<?php

require_once __DIR__ . '/../component.php';
require_once __DIR__ . '/assets/page.php';

class NavBarOptions implements IComponentOptions
{

    public function __construct(
        /** @var array<Page> */
        public array $pages = [],
    ) {}

    /** @return array<Page> */
    public function getPages(): array
    {
        return $this->pages;
    }
}

class NavBarComponent implements IComponent
{

    function render(IComponentOptions $options): void
    {
        if (!($options instanceof NavBarOptions)) {
            throw new InvalidArgumentException('NavBarComponent expects an instance of NavBarOptions.');
        }

        $pages = $options->getPages();

        usort($pages, function ($left, $right) {
            return ($left->options->order ?? PHP_INT_MAX) <=> ($right->options->order ?? PHP_INT_MAX);
        });
?>
        <nav class="flex f-c-c main-nav">
            <?php foreach ($pages as $page): ?>
                <a href="<?= $page->path ?>" class="flex f-ai-c nav-link">
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
