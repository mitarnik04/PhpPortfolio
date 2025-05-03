<?php
require_once __DIR__ . '/../helpers/translation.php';

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
?>

<div class="container">
    <h1><?php echo Translation::getTranslation('LANGUAGES_TITLE', $language); ?></h1>

    <div class="language-list">

        <div class="language-category">
            <h2>
                <?php echo Translation::getTranslation('CSHARP_NET_ECOSYSTEM', $language); ?>
            </h2>
            <p>
                <?php echo Translation::getTranslation('CSHARP_NET_ECOSYSTEM_DESCRIPTION', $language); ?>
            </p>
        </div>

        <div class="language-category">
            <h2>
                <?php echo Translation::getTranslation('FRONTEND', $language); ?>
            </h2>
            <p>
                <?php echo Translation::getTranslation('FRONTEND_DESCRIPTION', $language); ?>
            </p>
        </div>

        <div class="language-category">
            <h2>
                <?php echo Translation::getTranslation('DATABASES', $language); ?>
            </h2>
            <p>
                <?php echo Translation::getTranslation('DATABASES_DESCRIPTION', $language); ?>
            </p>
        </div>

        <div class="language-category">
            <h2>
                <?php echo Translation::getTranslation('VERSION_CTRL_TOOLING', $language); ?>
            </h2>
            <p>
                <?php echo Translation::getTranslation('VERSION_CTRL_TOOLING_DESCRIPTION', $language); ?>
            </p>
        </div>

        <div class="language-category">
            <h2>
                <?php echo Translation::getTranslation('OTHERS', $language); ?>
            </h2>
            <p>
                <?php echo Translation::getTranslation('OTHERS_DESCRIPTION', $language); ?>
            </p>
        </div>
    </div>
</div>