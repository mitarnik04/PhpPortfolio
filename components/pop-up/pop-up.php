<?php
require_once __DIR__ . '/../component.php';
require_once __DIR__ . '/assets/pop-up-type.php';
require_once __DIR__ . '/assets/pop-up-button.php';

class PopUpOptions implements IComponentOptions
{
    /** @param array<Button> $buttons */
    public function __construct(
        public readonly string $name,
        public readonly string $body,
        public readonly PopUpType $type,
        public readonly ?string $title = null,
        public readonly array $buttons = [],
        public readonly bool $show = false
    ) {}
}

class PopUpComponent implements IComponent
{
    public readonly string $name;

    /** @param PopUpOptions $options */
    public function render(IComponentOptions $options): void
    {
        if (!($options instanceof PopUpOptions)) {
            throw new InvalidArgumentException(
                'PopUpComponent expects an instance of PopUpOptions.'
            );
        }

        $this->name = $options->name;
        $showAttr = $options->show ? ' data-popup-show="true"' : '';
?>
        <div id="<?= htmlspecialchars($options->name) ?>" class="f-c-c popup-overlay" aria-hidden="true" <?= $showAttr ?>>
            <div class="popup">
                <a href="#" class="popup-close" data-popup-id="<?= htmlspecialchars($options->name) ?>" data-popup-close="true">
                    <span class="material-icons">close</span>
                </a>
                <?php if (isset($options->title)): ?>
                    <header class="flex f-ai-c popup-header">
                        <span class="material-icons popup-header-icon">
                            <?= match ($options->type) {
                                PopUpType::Info => '<span class="material-icons popup-header-icon">info</span>',
                                PopUpType::Error => '<span class="material-icons popup-error popup-header-icon">error</span>',
                                PopUpType::Form => '<span class="material-icons popup-header-icon">dashboard</span>',
                                default => '',
                            } ?>
                        </span>
                        <h2 class="popup-title"><?= htmlspecialchars($options->title) ?></h2>
                    </header>
                <?php endif; ?>
                <div class="popup-body">
                    <?= $options->body ?>
                </div>
                <?php if (!empty($options->buttons)): ?>
                    <div class="flex f-jc-fe f-g-6px popup-buttons">
                        <?php foreach ($options->buttons as $button): ?>
                            <button
                                type="<?= htmlspecialchars($button->type, ENT_QUOTES) ?>"
                                class="<?= htmlspecialchars($button->class, ENT_QUOTES) ?>"
                                onclick="<?= htmlspecialchars($button->onClick, ENT_QUOTES) ?>"
                                data-popup-id="<?= htmlspecialchars($options->name) ?>"
                                data-popup-close="<?= $button->closePopUpOnClick ? 'true' : 'false' ?>">
                                <?= htmlspecialchars($button->label, ENT_QUOTES) ?>
                            </button>

                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
<?php
    }
}
