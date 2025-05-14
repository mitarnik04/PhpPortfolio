<?php

require_once __DIR__ . '/user-settings.php';
require_once DIR_HELPERS . '/translation.php';
require_once DIR_HELPERS . '/metadata.php';
require_once DIR_HELPERS . '/instance-provider.php';


$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();

$availableLanguages = Metadata::getAvailableLanguages();

if (isset($_GET['lang']) && in_array($_GET['lang'], $availableLanguages)) {
    $newLang = $_GET['lang'];
    if ($userSettings->getLanguage() !== $newLang) {
        $userSettings->setLanguage($newLang);
        // Redirect to remove ?lang=... from the URL
        header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
        exit;
    }
}

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
        require_once DIR_COMPONENTS . '/nav-bar/nav-bar.php';
        require_once DIR_HELPERS . '/router.php';

        $paths = [];
        $router = InstanceProvider::get(Router::class);
        $translation = InstanceProvider::get(Translation::class);


        $allowedPages = Metadata::getLoadableViews();
        foreach ($allowedPages as $allowedPage) {
            $paths[] = new Page(
                '/' . $allowedPage,
                $translation->get('SPA_SETUP:' . strtoupper($allowedPage), $language),
                $allowedPage
            );
        }

        (new NavBarComponent())->render(new NavBarOptions(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $paths));

        require_once DIR_COMPONENTS . '/language-toggle/language-toggle.php';
        (new LanguageToggleComponent())->render(new LanguageToggleOptions($language, $availableLanguages));
        ?>
    </div>

    <div id="spa-content">
        <?php $router->route() ?>
    </div>

</body>

</html>