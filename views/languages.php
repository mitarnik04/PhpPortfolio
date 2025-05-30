<?php
$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
?>

<h1><?= $translator->get('LANGUAGES_PAGE:TITLE', $language); ?></h1>
<h2><?= $translator->get('LANGUAGES_PAGE:TAGLINE', $language); ?></h2>

<div class="flex f-dr-c f-g-20px card-container">

    <?php
    require_once DIR_COMPONENTS . '/card/card.php';

    (new CardComponent())->render(new CardOptions(
        $translator->get('LANGUAGES_PAGE:CSHARP_NET_ECOSYSTEM', $language),
        $translator->get('LANGUAGES_PAGE:CSHARP_NET_ECOSYSTEM_DESCRIPTION', $language)
    ));

    (new CardComponent())->render(new CardOptions(
        $translator->get('LANGUAGES_PAGE:FRONTEND', $language),
        $translator->get('LANGUAGES_PAGE:FRONTEND_DESCRIPTION', $language)
    ));

    (new CardComponent())->render(new CardOptions(
        $translator->get('LANGUAGES_PAGE:DATABASES', $language),
        $translator->get('LANGUAGES_PAGE:DATABASES_DESCRIPTION', $language)
    ));

    (new CardComponent())->render(new CardOptions(
        $translator->get('LANGUAGES_PAGE:VERSION_CTRL_TOOLING', $language),
        $translator->get('LANGUAGES_PAGE:VERSION_CTRL_TOOLING_DESCRIPTION', $language)
    ));

    (new CardComponent())->render(new CardOptions(
        $translator->get('LANGUAGES_PAGE:OTHERS', $language),
        $translator->get('LANGUAGES_PAGE:OTHERS_DESCRIPTION', $language)
    ));

    ?>

</div>