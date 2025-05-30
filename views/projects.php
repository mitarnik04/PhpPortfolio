<?php
$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
?>

<h1><?= $translator->get('PROJECTS_PAGE:TITLE', $language); ?></h1>
<h2><?= $translator->get('PROJECTS_PAGE:TAGLINE', $language); ?></h2>

<p>
    <?= $translator->get('PROJECTS_PAGE:INTRO_PARAGRAPH', $language); ?>
</p>

<div class="flex f-dr-c f-g-20px card-container">
    <?php
    require_once DIR_COMPONENTS . '/card/card.php';

    (new CardComponent())->render(new CardOptions(
        $translator->get('PROJECTS_PAGE:PORTFOLIO_TITLE', $language),
        $translator->get('PROJECTS_PAGE:PORTFOLIO_DESC', $language),
        $translator->get('PROJECTS_PAGE:PORTFOLIO_TAGLINE', $language)
    ));
    ?>
    <div class="flex f-jc-c">
        <a class="button-base github-link"
            href="https://github.com/mitarnik04/PHPPortfolio"
            target="_blank"
            rel="noopener noreferrer">
            <span class="material-icons" style="vertical-align:middle;">code</span>
            <?= $translator->get('PROJECTS_PAGE:GITHUB_BUTTON', $language) ?>
        </a>
    </div>
</div>