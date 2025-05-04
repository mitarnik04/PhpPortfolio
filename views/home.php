<?php
require_once __DIR__ . "/../helpers/translation.php";

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
?>


<div class="container">
    <img src="images/serious_pic.jpg" alt="Your Profile Picture" class="profile-pic">

    <h1><?= Translation::getTranslation('HOME_PAGE:GREETING', $language) ?></h1>

    <h2><?= Translation::getTranslation('HOME_PAGE:OCCUPATION_TITLE', $language) ?></h2>

    <p><?= Translation::getTranslation('HOME_PAGE:STUFF_I_DO_DESCRIPTION', $language) ?></p>

    <!-- //TODO: Move this into translation file ??  -->
    <div class="social-links">
        <a href="#">GitHub</a>
        <a href="https://www.linkedin.com/in/mitar-nikolic-79a2151a5">LinkedIn</a>
        <a href="#">Twitter</a>
    </div>

    <a href="mailto:you@example.com" class="contact-button">
        <?= Translation::getTranslation('HOME_PAGE:GET_IN_TOUCH', $language) ?>
    </a>
</div>