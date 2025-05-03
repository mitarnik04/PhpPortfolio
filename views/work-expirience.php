<?php
require_once __DIR__ . "/../helpers/translation.php";

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
?>

<div class="container">
    <h1><?php echo Translation::getTranslation('WORK_EXP_PAGE:TITLE', $language); ?></h1>
    <h2><?php echo Translation::getTranslation('WORK_EXP_PAGE:SUBTITLE', $language); ?></h2>

    <div class="experience-list">
        <div class="experience-item">
            <h3><?php echo Translation::getTranslation('WORK_EXP_PAGE:NEOGEO_TITLE', $language); ?></h3>
            <p class="experience-date"><?php echo Translation::getTranslation('WORK_EXP_PAGE:NEOGEO_TAGLINE', $language); ?></p>
            <p><?php echo Translation::getTranslation('WORK_EXP_PAGE:NEOGEO_DESC', $language); ?></p>
        </div>

        <div class="experience-item">
            <h3><?php echo Translation::getTranslation('WORK_EXP_PAGE:FOCUS_TITLE', $language); ?></h3>
            <p class="experience-date"><?php echo Translation::getTranslation('WORK_EXP_PAGE:FOCUS_TAGLINE', $language); ?></p>
            <p><?php echo Translation::getTranslation('WORK_EXP_PAGE:FOCUS_DESC', $language); ?></p>
        </div>
    </div>
</div>