<?php
require_once __DIR__ . '/../component.php';
require_once __DIR__ . '/assets/pop-up-type.php';

class PopUpOptions implements IComponentOptions
{
    public function __construct(
        public readonly string $name,
        public readonly string $contentFile,
        public readonly PopUpType $type,
        public readonly ?string $title = null,
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

        <div id="<?= $options->name ?>" class="f-c-c popup-overlay">
            <div class="popup">
                <a href="#" class="popup-close">
                    <span class="material-icons">close</span>
                </a>
                <?php if (isset($options->title)): ?>
                    <header class="flex f-ai-c popup-header">
                        <span class="material-icons popup-header-icon">
                            <?= match ($options->type) {
                                PopUpType::Info => ' <span class="material-icons popup-header-icon">info</span>',
                                PopUpType::Error => '<span class="material-icons popup-error popup-header-icon">error</span>',
                                PopUpType::Form => '<span class="material-icons popup-header-icon">dashboard</span>',
                                default => '',
                            } ?>
                        </span>
                        <h2 class="popup-title"><?= $options->title ?></h2>
                    </header>
                <?php endif; ?>
                <?php require $options->contentFile ?>
            </div>
        </div>
<?php
    }
}
