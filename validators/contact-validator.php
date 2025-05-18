<?php
require_once __DIR__ . '/validator.php';


class ContactValidationRequest extends ValidationRequest
{
    public function __construct(string $name, string $email, string $message)
    {
        $this->data['name'] = trim($name);
        $this->data['email'] = trim($email);
        $this->data['message'] = htmlspecialchars(trim($message));
    }
}

class ContactValidator implements IValidator
{
    private const AREA_NAME = 'NAME';
    private const AREA_EMAIL = 'EMAIL';
    private const AREA_MESSAGE = 'MESSAGE';


    /** @param ContactValidationRequest $request*/
    public function validate(ValidationRequest $request): array
    {
        if (!($request instanceof ContactValidationRequest)) {
            throw new InvalidArgumentException(
                'ContactValidator expects an instance of ContactValidationRequest.'
            );
        }
        $errors = [];

        self::validateName($request->data['name'], $errors);
        self::validateEmail($request->data['email'], $errors);
        self::validateMessage($request->data["message"], $errors);

        return $errors;
    }

    /** @param array<Error> &$errors */
    private static function validateName(string $name, array &$errors): void
    {
        if (empty($name)) {
            $errors[] = new ValidationError(self::AREA_NAME, 'NAME_EMPTY');
        } else if (preg_match("/\p{L}/u", $name) !== 1) {
            $errors[] = new ValidationError(self::AREA_NAME, 'NAME_DOES_NOT_CONTAIN_ANY_LETTERS');
        } else if (preg_match("/^[\p{L} '-]+$/u", $name) !== 1) {
            $errors[] = new ValidationError(self::AREA_NAME, 'NAME_UNALLOWED_CHARS');
        }
    }

    private static function validateEmail(string $email, array &$errors)
    {
        if (empty($email)) {
            $errors[] = new ValidationError(self::AREA_EMAIL, "EMAIL_EMPTY");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] =  new ValidationError(self::AREA_EMAIL, 'EMAIL_INVALID_FORMAT');
        }
    }

    private static function validateMessage(string $message, array &$errors)
    {
        if (empty($message)) {
            $errors[] = new ValidationError(self::AREA_MESSAGE, 'MESSAGE_EMPTY');
        } elseif (mb_strlen(trim($message)) < 10) {
            $errors[] = new ValidationError(self::AREA_MESSAGE, 'MESSAGE_TOO_SHORT');
        }
    }
}
