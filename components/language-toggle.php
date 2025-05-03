<?php

require_once(__DIR__ . '/component.php');

class LanguageToggleOptions implements IComponentOptions
{
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
            'selectedLanguage' => $this->selectedLanguage,
            'availableLanguages' => $this->availableLanguages
        ];
    }
}

class LanguageToggle implements IComponent
{

    public function render(IComponentOptions $options): void
    {

        $configuredOptions = $options->getAllOptions();
        $selectedLanguage = $configuredOptions['selectedLanguage'];
        $selectableLanguages = $configuredOptions['availableLanguages'];

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
