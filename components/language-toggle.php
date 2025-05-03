<?php

require_once(__DIR__ . '/component.php');

class LanguageToggleOptions implements IComponentOptions
{

    const OPT_KEY_SELECTED_LANGUAGE =   'selectedLanguage';
    const OPT_KEY_AVAILABLE_LANGUAGES =  'availableLanguages';

    public string $selectedLanguage;
    public array $availableLanguages;

    public function __construct(string $selectedLanguage, array $availableLanguages)
    {
        $this->selectedLanguage = $selectedLanguage;
        $this->availableLanguages = $availableLanguages;
    }

    public function getAllOptions(): array
    {
        return [
            self::OPT_KEY_SELECTED_LANGUAGE => $this->selectedLanguage,
            self::OPT_KEY_AVAILABLE_LANGUAGES => $this->availableLanguages
        ];
    }
}

class LanguageToggle implements IComponent
{

    public function render(IComponentOptions $options): void
    {

        $configuredOptions = $options->getAllOptions();
        $selectedLanguage = $configuredOptions[LanguageToggleOptions::OPT_KEY_SELECTED_LANGUAGE];
        $selectableLanguages = $configuredOptions[LanguageToggleOptions::OPT_KEY_AVAILABLE_LANGUAGES];

        require_once(__DIR__ . '/../helpers/translation-utils.php');

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
