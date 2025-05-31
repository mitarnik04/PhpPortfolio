<?php
require_once __DIR__ . '/user-settings.php';
require_once __DIR__ . '/dependencies.php';
require_once DIR_HELPERS . '/metadata.php';

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
$container = buildContainer();

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
    <!-- Maybe the versioning can be done automatically ? -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/public/images/portfolio_fav.png">
    <link rel="stylesheet" href="public/styles/flexbox.css?v2">
    <link rel="stylesheet" href="public/styles/styles.css?v3">
    <link rel="stylesheet" href="public/styles/scrollbar.css?v2">
    <link rel="stylesheet" href="public/styles/navigation.css?v4">
    <link rel="stylesheet" href="public/styles/language-toggle.css?v3">
    <link rel="stylesheet" href="public/styles/card.css?v3">
    <link rel="stylesheet" href="public/styles/pop-up.css?v3">
    <link rel="stylesheet" href="public/styles/spinner.css?v2">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Mitar's Portfolio</title>
</head>

<body class="flex f-ai-c f-dr-c">
    <header class="flex f-c-c header-bar">
        <?php
        require_once DIR_COMPONENTS . '/nav-bar/nav-bar.php';
        require_once DIR_HELPERS . '/router.php';

        $paths = [];
        $router = $container->get(Router::class);
        $translator = $container->get(Translator::class);

        $allowedPages = Metadata::getLoadableViews();
        foreach ($allowedPages as $allowedPage) {
            $paths[] = new Page(
                '/' . $allowedPage,
                $translator->get('SPA_SETUP:' . strtoupper($allowedPage), $language),
                $allowedPage
            );
        }

        (new NavBarComponent())->render(new NavBarOptions($router->getCurrentPath(), $paths));

        require_once DIR_COMPONENTS . '/language-toggle/language-toggle.php';
        (new LanguageToggleComponent())->render(new LanguageToggleOptions($language, $availableLanguages));
        ?>
    </header>

    <main id="main-container" class="container">
        <?php $router->route(["translator" => $translator]); ?>
    </main>

    <!-- JS -->
    <script type="module" src="public/js/popUp.js"></script>
    <!-- JS Utils -->
    <script type="module" src="public/js/utils/utils.js"></script>
    <script type="module" src="public/js/utils/popUpUtils.js"></script>
    <script type="module" src="public/js/utils/spinnerUtils.js"></script>
</body>

</html>