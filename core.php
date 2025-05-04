<?php

require_once __DIR__ . '/user-settings.php';
require_once __DIR__ . '/helpers/translation.php';
require_once __DIR__ . '/helpers/translation-utils.php';
require_once __DIR__ . '/helpers/spa-utils.php';

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
    <link rel="stylesheet" href="styles/flexbox.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/navigation.css">
    <link rel="stylesheet" href="styles/language-toggle.css">
    <link rel="stylesheet" href="styles/card.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Mitar's Portfolio</title>
</head>

<body class="flex f-c-c f-dr-c">

    <div class="flex f-c-c f-w header-bar">
        <?php
        require_once __DIR__ . '/components/nav-bar/nav-bar.php';

        $paths = [];

        foreach ($allowedPages as $allowedPage) {
            $paths[] = new Page(
                '/' . $allowedPage,
                Translation::getTranslation('SPA_SETUP:' . strtoupper($allowedPage), $language),
                $allowedPage
            );
        }

        (new NavBarComponent())->render(new NavBarOptions($paths));

        require_once __DIR__ . '/components/language-toggle/language-toggle.php';
        (new LanguageToggleComponent())->render(new LanguageToggleOptions($language, $availableLanguages));
        ?>
    </div>

    <div id="spa-content">
        <?php
        require_once __DIR__ . '/helpers/router.php';

        //TODO: Maybe do not hardcode default endpoint ? 
        Router::initialize($allowedPages, 'home');
        ?>
    </div>

</body>

</html>