<!-- 3. Add mailing logic -->
<!--TODO: Maybe consider creating a Form Component ??? -->

<?php
require_once DIR_HELPERS . '/translation.php';
require_once DIR_HELPERS . '/instance-provider.php';

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
$translation = InstanceProvider::get(Translation::class);

require_once DIR_VALIDATORS . '/contact-validator.php';
if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $validator = new ContactValidator();
    $errors = $validator->validate(new ContactValidationRequest($name, $email, $message));
}
?>

<?php if (!empty($errors)): ?>
    <div class="form-errors-container">
        <ul class="flex f-dr-c f-g-6px form-errors-list">
            <?php foreach ($errors as $error): ?>
                <li>
                    <?= $translation->get("ERROR:$error->key", $language) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="" method="post">
    <div class="form-group">
        <label for="name"><?= $translation->get('CONTACT:NAME', $language) ?></label>
        <input
            class="form-input"
            id="name"
            name="name"
            type="text"
            required
            minlength="2"
            maxlength="50"
            pattern="^[A-Za-zÀ-ÖØ-öø-ÿ\- ]+$"
            title="<?= $translation->get('CONTACT:PROMPT:ENTER_VALID_NAME', $language) ?>">
    </div>

    <div class="form-group">
        <label for="email"><?= $translation->get('CONTACT:EMAIL', $language) ?></label>
        <input
            class="form-input"
            id="email"
            name="email"
            type="email"
            required
            maxlength="100">
    </div>

    <div class="form-group">
        <label for="message"><?= $translation->get('CONTACT:MESSAGE', $language) ?></label>
        <textarea
            class="form-input"
            id="message"
            name="message"
            rows="5"
            required
            minlength="10"
            title="<?= $translation->get('CONTACT:PROMPT:ENTER_MESSAGE', $language) ?>"></textarea>
    </div>

    <input type="submit" name="submit" value="<?= $translation->get('CONTACT:SEND', $language) ?>" class="button-base form-submit">
</form>