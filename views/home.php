<?php
require_once(__DIR__ . "/../helpers/translation.php");

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
?>


<div class="container">
    <img src="images/serious_pic.jpg" alt="Your Profile Picture" class="profile-pic">

    <h1><?php echo Translation::getTranslation('GREETING', $language) ?></h1>

    <h2><?php echo Translation::getTranslation('OCCUPATION_TITLE', $language) ?></h2>

    <p><?php echo Translation::getTranslation('STUFF_I_DO_DESCRIPTION', $language) ?></p>

    <div class="social-links">
        <a href="#">GitHub</a>
        <a href="#">LinkedIn</a>
        <a href="#">Twitter</a>
    </div>

    <a href="mailto:you@example.com" class="contact-button">
        <?php echo Translation::getTranslation('GET_IN_TOUCH', $language) ?>
    </a>
</div>