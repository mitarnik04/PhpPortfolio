<?php
require_once DIR_HELPERS . '/translation.php';

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
$translation = InstanceProvider::get(Translation::class);
?>

<h1><?= $translation->get('PROJECTS_PAGE:TITLE', $language); ?></h1>
<h2><?= $translation->get('PROJECTS_PAGE:TAGLINE', $language); ?></h2>

<p style="margin-bottom: 30px; font-size:1.1em; color:#444;">
    <?= $translation->get('PROJECTS_PAGE:INTRO_PARAGRAPH', $language); ?>
</p>

<div class="flex f-dr-c f-g-20px card-container">
    <?php
    require_once DIR_COMPONENTS . '/card/card.php';

    (new CardComponent())->render(new CardOptions(
        $translation->get('PROJECTS_PAGE:PORTFOLIO_TITLE', $language),
        $translation->get('PROJECTS_PAGE:PORTFOLIO_DESC', $language),
        $translation->get('PROJECTS_PAGE:PORTFOLIO_TAGLINE', $language)
    ));
    ?>
    <div class="flex f-jc-c" style="margin-top:24px;">
        <a class="button-base github-link"
            href="https://github.com/mitarnik04/portfolio"
            target="_blank"
            rel="noopener noreferrer">
            <span class="material-icons" style="vertical-align:middle;">code</span>
            <?= $translation->get('PROJECTS_PAGE:GITHUB_BUTTON', $language) ?>
        </a>
    </div>
</div>