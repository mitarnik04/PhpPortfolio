<?php
require_once(__DIR__ . '/../helpers/translation.php');

?>

<div class="container">
    <h1><?php echo Translation::getTranslation('PROJECTS_TITLE', $language); ?></h1>
    <ul>
        <li><strong>Portfolio Website</strong> – <?php echo Translation::getTranslation('PROJECTS_DESC_PORTFOLIO', $language); ?></li>
        <li><strong>CLI Tool</strong> – <?php echo Translation::getTranslation('PROJECTS_DESC_CLI', $language); ?></li>
    </ul>
    <a href="home.php"><?php echo Translation::getTranslation('BACK_HOME', $language); ?></a>
</div>