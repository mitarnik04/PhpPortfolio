<?php
require_once DIR_HELPERS . "/translation.php";

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
?>

<div class="container">
    <h1><?= Translation::getTranslation('WORK_EXP_PAGE:TITLE', $language); ?></h1>
    <h2><?= Translation::getTranslation('WORK_EXP_PAGE:SUBTITLE', $language); ?></h2>

    <div class="flex f-dr-c f-g-20px card-container">

        <?php

        require_once DIR_COMPONENTS . '/card/card.php';

        (new CardComponent())->render(new CardOptions(
            Translation::getTranslation('WORK_EXP_PAGE:NEOGEO_TITLE', $language),
            Translation::getTranslation('WORK_EXP_PAGE:NEOGEO_DESC', $language),
            Translation::getTranslation('WORK_EXP_PAGE:NEOGEO_TAGLINE', $language)
        ));

        (new CardComponent())->render(new CardOptions(
            Translation::getTranslation('WORK_EXP_PAGE:FOCUS_TITLE', $language),
            Translation::getTranslation('WORK_EXP_PAGE:FOCUS_DESC', $language),
            Translation::getTranslation('WORK_EXP_PAGE:FOCUS_TAGLINE', $language)
        ));

        ?>
    </div>
</div>