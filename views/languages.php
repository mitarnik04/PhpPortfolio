<?php
require_once DIR_HELPERS . '/translation.php';

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
?>

<div class="container">
    <h1><?= Translation::getTranslation('LANGUAGES_PAGE:TITLE', $language); ?></h1>

    <div class="flex f-dr-c f-g-20px card-container">

        <?php
        require_once DIR_COMPONENTS . '/card/card.php';

        (new CardComponent())->render(new CardOptions(
            Translation::getTranslation('LANGUAGES_PAGE:CSHARP_NET_ECOSYSTEM', $language),
            Translation::getTranslation('LANGUAGES_PAGE:CSHARP_NET_ECOSYSTEM_DESCRIPTION', $language)
        ));

        (new CardComponent())->render(new CardOptions(
            Translation::getTranslation('LANGUAGES_PAGE:FRONTEND', $language),
            Translation::getTranslation('LANGUAGES_PAGE:FRONTEND_DESCRIPTION', $language)
        ));

        (new CardComponent())->render(new CardOptions(
            Translation::getTranslation('LANGUAGES_PAGE:DATABASES', $language),
            Translation::getTranslation('LANGUAGES_PAGE:DATABASES_DESCRIPTION', $language)
        ));

        (new CardComponent())->render(new CardOptions(
            Translation::getTranslation('LANGUAGES_PAGE:VERSION_CTRL_TOOLING', $language),
            Translation::getTranslation('LANGUAGES_PAGE:VERSION_CTRL_TOOLING_DESCRIPTION', $language)
        ));

        (new CardComponent())->render(new CardOptions(
            Translation::getTranslation('LANGUAGES_PAGE:OTHERS', $language),
            Translation::getTranslation('LANGUAGES_PAGE:OTHERS_DESCRIPTION', $language)
        ));

        ?>

    </div>

</div>