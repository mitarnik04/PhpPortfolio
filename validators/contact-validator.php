<?php
require_once __DIR__ . '/validator.php';

class ContactValidationRequest extends ValidationRequest
{
    public function __construct(
        string $firstname,
        string $lastname,
        string $email,
        string $message,
        string $reason,
        array $validReasons = []
    ) {
        $this->data['firstname'] = trim($firstname);
        $this->data['lastname'] = trim($lastname);
        $this->data['email'] = trim($email);
        $this->data['message'] = trim($message);
        $this->data['reason'] = trim($reason);
        $this->data['validReasons'] = $validReasons;
    }
}

class ContactValidator implements IValidator
{
    private const AREA_NAME = 'NAME';
    private const AREA_EMAIL = 'EMAIL';
    private const AREA_MESSAGE = 'MESSAGE';
    private const AREA_REASON = 'REASON';


    private const REGEX_CONTAINS_LETTER = "/\p{L}/u";
    private const REGEX_ALLOWED_TXT_CHARS = "/^[\p{L} '-]+$/u";

    /** @param ContactValidationRequest $request*/
    public function validate(ValidationRequest $request): array
    {
        if (!($request instanceof ContactValidationRequest)) {
            throw new InvalidArgumentException(
                'ContactValidator expects an instance of ContactValidationRequest.'
            );
        }
        $errors = [];

        self::validateFirstName($request->data['firstname'], $errors);
        self::validateLastName($request->data['lastname'], $errors);
        self::validateEmail($request->data['email'], $errors);
        self::validateMessage($request->data["message"], $errors);
        self::validateReason($request->data['reason'], $request->data['validReasons'], $errors);

        return $errors;
    }

    /** @param array<Error> &$errors */
    private static function validateFirstName(string $firstName, array &$errors): void
    {
        if (empty($firstName)) {
            $errors[] = new ValidationError(self::AREA_NAME, 'FIRST_NAME_EMPTY');
        } else if (preg_match(self::REGEX_CONTAINS_LETTER, $firstName) !== 1) {
            $errors[] = new ValidationError(self::AREA_NAME, 'FIRST_NAME_DOES_NOT_CONTAIN_ANY_LETTERS');
        } else if (preg_match(self::REGEX_ALLOWED_TXT_CHARS, $firstName) !== 1) {
            $errors[] = new ValidationError(self::AREA_NAME, 'FIRST_NAME_UNALLOWED_CHARS');
        }
    }

    /** @param array<Error> &$errors */
    private static function validateLastName(string $lastName, array &$errors): void
    {
        if (empty($lastName)) {
            $errors[] = new ValidationError(self::AREA_NAME, 'LAST_NAME_EMPTY');
        } else if (preg_match(self::REGEX_CONTAINS_LETTER, $lastName) !== 1) {
            $errors[] = new ValidationError(self::AREA_NAME, 'LAST_NAME_DOES_NOT_CONTAIN_ANY_LETTERS');
        } else if (preg_match(self::REGEX_ALLOWED_TXT_CHARS, $lastName) !== 1) {
            $errors[] = new ValidationError(self::AREA_NAME, 'LAST_NAME_UNALLOWED_CHARS');
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

    private static function validateReason(string $reason, array $validReasons, array &$errors)
    {
        if (empty($reason)) {
            $errors[] = new ValidationError(self::AREA_REASON, 'REASON_EMPTY');
        } elseif (in_array($reason, $validReasons, true) === false) {
            $errors[] = new ValidationError(self::AREA_REASON, 'REASON_INVALID');
        }
    }
}
