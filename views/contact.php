<!--TODO: Maybe consider creating a Form Component ??? -->

<?php
require_once DIR_MAIL . '/mailer.php';
require_once DIR_MAIL . '/mail-information.php';
require_once DIR_MAIL . '/templates/contact-mail-template.php';
require_once DIR_VALIDATORS . '/contact-validator.php';
require_once DIR_COMPONENTS . '/pop-up/pop-up-renderer.php';

$userSettings = UserSettings::getOrCreate();
$language = $userSettings->getLanguage();
$mailState = MailState::IDLE;

if (isset($_POST['submit'])) {
    $reason = $_POST['reason'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    $validator = new ContactValidator();
    $errors = $validator->validate(new ContactValidationRequest(
        $reason,
        ['collaboration', 'freelance', 'techchat', 'other'],
        $firstname,
        $lastname,
        $email,
        $message,
    ));

    if (empty($errors)) {
        $mailInformation = MailInformation::fromConfiguration();
        $mailer = Mailer::getGmailMailer($mailInformation);
        $mailState = $mailer->sendFromTemplate($mailInformation, new ContactMailTemplate(
            $reason,
            $firstname,
            $lastname,
            $email,
            $message
        ));
    }
}
?>

<h1><?= $translator->get('CONTACT_PAGE:TITLE', $language) ?></h1>
<h2 class="contact-subtitle"><?= $translator->get('CONTACT_PAGE:SUBTITLE', $language) ?></h2>
<p class="contact-intro"><?= $translator->get('CONTACT_PAGE:INTRO', $language) ?></p>


<?php if (!empty($errors)): ?>
    <div class="flex f-js-c form-errors-container">
        <ul class="flex f-dr-c f-g-20px form-errors-list">
            <?php foreach ($errors as $error): ?>
                <li>
                    <?= $translator->get("ERROR:$error->key", $language) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div id="spinner" class="spinner spinner-overlay">
    <div class="loader"></div>
</div>

<form action="" method="post" id="contactForm">
    <div class="form-group">
        <label for="reason" class="form-label"><?= $translator->get('CONTACT_PAGE:REASON:LABEL', $language) ?></label>
        <!-- TODO: Can this <select> be a component ? -->
        <select
            class="form-input"
            id="reason"
            name="reason"
            required>
            <option value=""><?= $translator->get('CONTACT_PAGE:REASON:PLACEHOLDER', $language) ?></option>
            <option value="collaboration" <?= (isset($reason) && $reason === 'collaboration') ? 'selected' : '' ?>>
                <?= $translator->get('CONTACT_PAGE:REASON:COLLABORATION', $language) ?>
            </option>
            <option value="freelance" <?= (isset($reason) && $reason === 'freelance') ? 'selected' : '' ?>>
                <?= $translator->get('CONTACT_PAGE:REASON:FREELANCE', $language) ?>
            </option>
            <option value="techchat" <?= (isset($reason) && $reason === 'techchat') ? 'selected' : '' ?>>
                <?= $translator->get('CONTACT_PAGE:REASON:TECHCHAT', $language) ?>
            </option>
            <option value="other" <?= (isset($reason) && $reason === 'other') ? 'selected' : '' ?>>
                <?= $translator->get('CONTACT_PAGE:REASON:OTHER', $language) ?>
            </option>
        </select>
    </div>
    <div class="form-group">
        <label for="firstname" class="form-label"><?= $translator->get('CONTACT_PAGE:FIRSTNAME', $language) ?></label>
        <input
            class="form-input"
            id="firstname"
            name="firstname"
            type="text"
            required
            minlength="2"
            maxlength="50"
            pattern="^[A-Za-zÀ-ÖØ-öø-ÿ\- ]+$"
            title="<?= $translator->get('CONTACT_PAGE:PROMPT:ENTER_VALID_NAME', $language) ?>"
            value="<?= isset($firstname) ? htmlspecialchars($firstname, ENT_QUOTES) : '' ?>">
    </div>
    <div class="form-group">
        <label for="lastname" class="form-label"><?= $translator->get('CONTACT_PAGE:LASTNAME', $language) ?></label>
        <input
            class="form-input"
            id="lastname"
            name="lastname"
            type="text"
            required
            minlength="2"
            maxlength="50"
            pattern="^[A-Za-zÀ-ÖØ-öø-ÿ\- ]+$"
            title="<?= $translator->get('CONTACT_PAGE:PROMPT:ENTER_VALID_NAME', $language) ?>"
            value="<?= isset($lastname) ? htmlspecialchars($lastname, ENT_QUOTES) : '' ?>">
    </div>

    <div class="form-group">
        <label for="email" class="form-label"><?= $translator->get('CONTACT_PAGE:EMAIL', $language) ?></label>
        <input
            class="form-input"
            id="email"
            name="email"
            type="email"
            required
            maxlength="100"
            value="<?= isset($email) ? htmlspecialchars($email, ENT_QUOTES) : '' ?>">
    </div>

    <div class="form-group">
        <label for="message" class="form-label"><?= $translator->get('CONTACT_PAGE:MESSAGE', $language) ?></label>
        <textarea
            class="form-input"
            id="message"
            name="message"
            rows="5"
            required
            minlength="10"
            title="<?= $translator->get('CONTACT_PAGE:PROMPT:ENTER_MESSAGE', $language) ?>"><?= isset($message) ? htmlspecialchars($message, ENT_QUOTES) : '' ?></textarea>
    </div>

    <input type="submit" name="submit" value="<?= $translator->get('CONTACT_PAGE:SEND', $language) ?>" class="button-base form-submit">
</form>

<?php if ($mailState == MailState::SUCCESS) {
    PopUpRenderer::renderSuccess(
        'contact-success',
        $translator->get('CONTACT_PAGE:SUCCESS_MESSAGE', $language),
        $translator->get('GENERAL:SUCCESS', $language),
        $translator->get('GENERAL:OK', $language),
    );
} else if ($mailState == MailState::ERROR) {
    PopUpRenderer::renderError(
        "contact-error",
        $translator->get('CONTACT_PAGE:ERROR_MESSAGE', $language),
        $translator->get('GENERAL:ERROR', $language),
        $translator->get('GENERAL:OK', $language),
    );
} ?>

<script type="module" src="/public/js/contact.js"></script>