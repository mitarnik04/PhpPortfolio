<?php
require_once  DIR_HELPERS . "/translation.php";

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
$translation = InstanceProvider::get(Translation::class);
?>


<div class="container">
    <div class="flex f-jc-c profile-pic-wrapper">
        <img src="images/serious_pic.jpg" alt="Your Profile Picture" class="profile-pic">
    </div>

    <h1><?= $translation->getTranslation('HOME_PAGE:GREETING', $language) ?></h1>

    <h2><?= $translation->getTranslation('HOME_PAGE:OCCUPATION_TITLE', $language) ?></h2>

    <p><?= $translation->getTranslation('HOME_PAGE:STUFF_I_DO_DESCRIPTION', $language) ?></p>

    <!-- //TODO: Move this into translation file ??  -->
    <div class="social-links">
        <a href="#">GitHub</a>
        <a href="https://www.linkedin.com/in/mitar-nikolic-79a2151a5">LinkedIn</a>
        <a href="#">Twitter</a>
    </div>

    <a href="mailto:you@example.com" class="contact-button">
        <?= $translation->getTranslation('HOME_PAGE:GET_IN_TOUCH', $language) ?>
    </a>
</div>