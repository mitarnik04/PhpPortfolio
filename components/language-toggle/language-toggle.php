<?php

require_once __DIR__ . '/../component.php';

class LanguageToggleOptions implements IComponentOptions
{
    public function __construct(
        private string $selectedLanguage,

        /**
         * @var array<string> List of ISO 639-1 language codes (e.g., ["en", "de", "fr"])
         */
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
                <?php

                foreach ($selectableLanguages as $languageOption):

                    $selectedAttr = ($selectedLanguage == $languageOption) ? 'selected' : '';
                    $loToUpper = strtoupper($languageOption);
                ?>
                    <option value="<?= $languageOption ?>" <?= $selectedAttr ?>>
                        <?= $loToUpper ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </form>
<?php
    }
}
