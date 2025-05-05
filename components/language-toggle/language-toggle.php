<?php

require_once __DIR__ . '/../component.php';

class LanguageToggleOptions implements IComponentOptions
{

    const OPT_KEY_SELECTED_LANGUAGE =   'selectedLanguage';

    const OPT_KEY_SELECTABLE_LANGUAGES =  'availableLanguages';

    private string $selectedLanguage;

    /**
     * @var array<string> List of ISO 639-1 language codes (e.g., ["en", "de", "fr"])
     */
    private array $selectableLanguages;

    public function __construct(string $selectedLanguage, array $selectableLanguages)
    {
        $this->selectedLanguage = $selectedLanguage;
        $this->selectableLanguages = $selectableLanguages;
    }

    public function getAllOptions(): array
    {
        return [
            self::OPT_KEY_SELECTED_LANGUAGE => $this->selectedLanguage,
            self::OPT_KEY_SELECTABLE_LANGUAGES => $this->selectableLanguages
        ];
    }
}

class LanguageToggleComponent implements IComponent
{

    /**
     * @param LanguageToggleOptions $options
     */
    public function render(IComponentOptions $options): void
    {
        if (!($options instanceof LanguageToggleOptions)) {
            throw new InvalidArgumentException(
                'LanguageToggleComponent expects an instance of LanguageToggleOptions.'
            );
        }

        $configuredOptions = $options->getAllOptions();
        $selectedLanguage = $configuredOptions[LanguageToggleOptions::OPT_KEY_SELECTED_LANGUAGE];
        $selectableLanguages = $configuredOptions[LanguageToggleOptions::OPT_KEY_SELECTABLE_LANGUAGES];

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
