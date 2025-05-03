<?php

require_once(__DIR__ . '/user-settings.php');
require_once(__DIR__ . '/helpers/translation.php');
require_once(__DIR__ . '/helpers/translation-utils.php');
require_once(__DIR__ . '/helpers/spa-utils.php');

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();

$availableLanguages = TranslationUtils::getAvailableTranslations();

if (isset($_GET['lang']) && in_array($_GET['lang'], $availableLanguages)) {
    $newLang = $_GET['lang'];
    if ($userSettings->getLanguage() !== $newLang) {
        $userSettings->setLanguage($newLang);
        // Redirect to remove ?lang=... from the URL
        header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
        exit;
    }
}

$allowedPages = SpaUtils::getPages();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/navigation.css">
    <link rel="stylesheet" href="styles/language-toggle.css">
    <title>Mitar's Portfolio</title>
</head>

<body>

    <?php
    require_once(__DIR__ . '/components/nav-bar.php');

    $paths = [];

    foreach ($allowedPages as $allowedPage) {
        $paths[] = new Path('/' . $allowedPage, Translation::getTranslation('PAGE_' . strtoupper($allowedPage), $language));
    }

    (new NavBarComponent())->render(new NavBarOptions($paths));

    require_once(__DIR__ . '/components/language-toggle.php');
    (new LanguageToggle())->render(new LanguageToggleOptions($language, $availableLanguages));
    ?>

    <div id="spa-content">
        <?php
        include(__DIR__ . '/helpers/router.php');

        //TODO: Maybe do not hardcode default endpoint ? 
        Router::initialize($allowedPages, 'home');
        ?>
    </div>

</body>

</html>