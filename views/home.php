<?php
$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
?>

<div class="flex f-jc-c profile-pic-wrapper">
    <img src="public/images/serious_pic.jpg" alt="Your Profile Picture" class="profile-pic">
</div>

<h1><?= $translator->get('HOME_PAGE:GREETING', $language) ?></h1>

<h2><?= $translator->get('HOME_PAGE:OCCUPATION_TITLE', $language) ?></h2>

<p><?= $translator->get('HOME_PAGE:STUFF_I_DO_DESCRIPTION', $language) ?></p>

<!-- //TODO: Move this into translation file ??  -->
<div class="social-links">
    <a href="https://github.com/mitarnik04">GitHub</a>
    <a href="https://www.linkedin.com/in/mitar-nikolic-79a2151a5">LinkedIn</a>
    <a href="https://www.instagram.com/mitar_nik/">Instagram</a>
</div>

<a class="button-base contact-button" href="/contact">
    <?= $translator->get('HOME_PAGE:GET_IN_TOUCH', $language) ?>
</a>