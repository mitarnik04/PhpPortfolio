<?php

require_once __DIR__ . '/../component.php';

class LanguageToggleOptions implements IComponentOptions
{

    const OPT_KEY_SELECTED_LANGUAGE =   'selectedLanguage';

    const OPT_KEY_SELECTABLE_LANGUAGES =  'availableLanguages';

    public string $selectedLanguage;

    /**
     * @var string[] List of ISO 639-1 language codes (e.g., ["en", "de", "fr"])
     */
    public array $selectableLanguages;

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

        echo '<div class="language-toggle">';
        foreach ($selectableLanguages as $languageOption) {
            $linkClass = ($selectedLanguage == $languageOption) ? 'active' : '';
            $loToUpper = strtoupper($languageOption);

            echo <<<HTML
                    <a href="?lang={$languageOption}" class="{$linkClass}">{$loToUpper}</a>
                 HTML;
        }
        echo '</div>';
    }
}
