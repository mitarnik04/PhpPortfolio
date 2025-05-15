<?php

require_once DIR_COMPONENTS . '/component.php';

class LanguageToggleOptions implements IComponentOptions
{
    /** @param array<string> $selectableLanguages List of ISO 639-1 language codes (e.g., ["en", "de", "fr"]) */
    public function __construct(
        private string $selectedLanguage,
        private array $selectableLanguages
    ) {}

    public function getSelectedLanguage()
    {
        return $this->selectedLanguage;
    }

    public function getSelectableLanguages()
    {
        return $this->selectableLanguages;
    }
}

class LanguageToggleComponent implements IComponent
{

    /** @param LanguageToggleOptions $options */
    public function render(IComponentOptions $options): void
    {
        if (!($options instanceof LanguageToggleOptions)) {
            throw new InvalidArgumentException(
                'LanguageToggleComponent expects an instance of LanguageToggleOptions.'
            );
        }

        $selectedLanguage = $options->getSelectedLanguage();
        $selectableLanguages = $options->getSelectableLanguages();

?>
        <form class="flex f-ai-c language-toggle" method="get" action="">
            <select name="lang" onchange="this.form.submit()">
                <?php foreach ($selectableLanguages as $languageOption): ?>

                    <option value="<?= $languageOption ?>" <?= ($selectedLanguage == $languageOption) ? 'selected' : '' ?>>
                        <?= strtoupper($languageOption) ?>
                    </option>

                <?php endforeach; ?>
            </select>
        </form>
<?php
    }
}
