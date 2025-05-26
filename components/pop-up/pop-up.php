<?php
require_once __DIR__ . '/../component.php';
require_once __DIR__ . '/assets/pop-up-type.php';
require_once __DIR__ . '/assets/pop-up-button.php';

class PopUpOptions implements IComponentOptions
{
    public function __construct(
        public readonly string $name,
        public readonly string $body,
        public readonly PopUpType $type,
        public readonly ?string $title = null,
        public readonly array $buttons = []
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
?>

        <div id="<?= $options->name ?>" class="f-c-c popup-overlay" aria-hidden="true">
            <div class="popup">
                <a href="#" class="popup-close"
                    onclick="PopUpUtils.hidePopUp('<?= $options->name ?>'); return false;">
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
                        <h2 class="popup-title"><?= $options->title ?></h2>
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
                                onclick="<?= htmlspecialchars($button->onClick) ?>">
                                <?= htmlspecialchars($button->label, ENT_QUOTES) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
<?php
    }

    public function show()
    {
        echo <<<JS
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        PopUpUtils.showPopUp('{$this->name}');
                        return false; 
                    });
                </script>
            JS;
    }
}
