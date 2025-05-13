<?php
require_once DIR_HELPERS . "/translation.php";

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
$translation = InstanceProvider::get(Translation::class);
?>

<div class="container">
    <h1><?= $translation->getTranslation('WORK_EXP_PAGE:TITLE', $language); ?></h1>
    <h2><?= $translation->getTranslation('WORK_EXP_PAGE:SUBTITLE', $language); ?></h2>

    <div class="flex f-dr-c f-g-20px card-container">

        <?php

        require_once DIR_COMPONENTS . '/card/card.php';

        (new CardComponent())->render(new CardOptions(
            $translation->getTranslation('WORK_EXP_PAGE:NEOGEO_TITLE', $language),
            $translation->getTranslation('WORK_EXP_PAGE:NEOGEO_DESC', $language),
            $translation->getTranslation('WORK_EXP_PAGE:NEOGEO_TAGLINE', $language)
        ));

        (new CardComponent())->render(new CardOptions(
            $translation->getTranslation('WORK_EXP_PAGE:FOCUS_TITLE', $language),
            $translation->getTranslation('WORK_EXP_PAGE:FOCUS_DESC', $language),
            $translation->getTranslation('WORK_EXP_PAGE:FOCUS_TAGLINE', $language)
        ));

        ?>
    </div>
</div>