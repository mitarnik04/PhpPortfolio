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

    <h1><?= $translation->get('HOME_PAGE:GREETING', $language) ?></h1>

    <h2><?= $translation->get('HOME_PAGE:OCCUPATION_TITLE', $language) ?></h2>

    <p><?= $translation->get('HOME_PAGE:STUFF_I_DO_DESCRIPTION', $language) ?></p>

    <!-- //TODO: Move this into translation file ??  -->
    <div class="social-links">
        <a href="https://github.com/mitarnik04">GitHub</a>
        <a href="https://www.linkedin.com/in/mitar-nikolic-79a2151a5">LinkedIn</a>
        <a href="https://www.instagram.com/mitar_nik/">Instagram</a>
    </div>


    <?php
    require_once DIR_COMPONENTS . '/pop-up/pop-up.php';
    $popUp = new PopUpComponent();

    $popUp->render(new PopUpOptions(
        'contact-form',
        __DIR__ . '/pop-ups/contact-form.php',
        PopUpType::Form,
        'This is a test'
    ));
    ?>

    <a href="#<?= $popUp->name ?>" class="button-base contact-button">
        <?= $translation->get('HOME_PAGE:GET_IN_TOUCH', $language) ?>
    </a>
</div>