<?php
require_once DIR_HELPERS . '/translation.php';

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
$translation = InstanceProvider::get(Translation::class);
?>

<div class="container">
    <h1><?= $translation->get('LANGUAGES_PAGE:TITLE', $language); ?></h1>

    <div class="flex f-dr-c f-g-20px card-container">

        <?php
        require_once DIR_COMPONENTS . '/card/card.php';

        (new CardComponent())->render(new CardOptions(
            $translation->get('LANGUAGES_PAGE:CSHARP_NET_ECOSYSTEM', $language),
            $translation->get('LANGUAGES_PAGE:CSHARP_NET_ECOSYSTEM_DESCRIPTION', $language)
        ));

        (new CardComponent())->render(new CardOptions(
            $translation->get('LANGUAGES_PAGE:FRONTEND', $language),
            $translation->get('LANGUAGES_PAGE:FRONTEND_DESCRIPTION', $language)
        ));

        (new CardComponent())->render(new CardOptions(
            $translation->get('LANGUAGES_PAGE:DATABASES', $language),
            $translation->get('LANGUAGES_PAGE:DATABASES_DESCRIPTION', $language)
        ));

        (new CardComponent())->render(new CardOptions(
            $translation->get('LANGUAGES_PAGE:VERSION_CTRL_TOOLING', $language),
            $translation->get('LANGUAGES_PAGE:VERSION_CTRL_TOOLING_DESCRIPTION', $language)
        ));

        (new CardComponent())->render(new CardOptions(
            $translation->get('LANGUAGES_PAGE:OTHERS', $language),
            $translation->get('LANGUAGES_PAGE:OTHERS_DESCRIPTION', $language)
        ));

        ?>

    </div>

</div>