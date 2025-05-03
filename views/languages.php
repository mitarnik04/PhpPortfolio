<?php
require_once __DIR__ . '/../helpers/translation.php';

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
?>

<div class="container">
    <h1><?php echo Translation::getTranslation('LANGUAGES_PAGE:TITLE', $language); ?></h1>

    <div class="language-list">

        <div class="language-category">
            <h2>
                <?php echo Translation::getTranslation('LANGUAGES_PAGE:CSHARP_NET_ECOSYSTEM', $language); ?>
            </h2>
            <p>
                <?php echo Translation::getTranslation('LANGUAGES_PAGE:CSHARP_NET_ECOSYSTEM_DESCRIPTION', $language); ?>
            </p>
        </div>

        <div class="language-category">
            <h2>
                <?php echo Translation::getTranslation('LANGUAGES_PAGE:FRONTEND', $language); ?>
            </h2>
            <p>
                <?php echo Translation::getTranslation('LANGUAGES_PAGE:FRONTEND_DESCRIPTION', $language); ?>
            </p>
        </div>

        <div class="language-category">
            <h2>
                <?php echo Translation::getTranslation('LANGUAGES_PAGE:DATABASES', $language); ?>
            </h2>
            <p>
                <?php echo Translation::getTranslation('LANGUAGES_PAGE:DATABASES_DESCRIPTION', $language); ?>
            </p>
        </div>

        <div class="language-category">
            <h2>
                <?php echo Translation::getTranslation('LANGUAGES_PAGE:VERSION_CTRL_TOOLING', $language); ?>
            </h2>
            <p>
                <?php echo Translation::getTranslation('LANGUAGES_PAGE:VERSION_CTRL_TOOLING_DESCRIPTION', $language); ?>
            </p>
        </div>

        <div class="language-category">
            <h2>
                <?php echo Translation::getTranslation('LANGUAGES_PAGE:OTHERS', $language); ?>
            </h2>
            <p>
                <?php echo Translation::getTranslation('LANGUAGES_PAGE:OTHERS_DESCRIPTION', $language); ?>
            </p>
        </div>
    </div>
</div>