<?php
require_once __DIR__ . '/../validators/contact-validator.php';

$tester = getTester('Contact');
$validator = new ContactValidator();


$tester->setUp(
    function () {
        return new ContactValidationRequest(
            'some reason',
            ['some reason', 'some other valid reason'],
            'SomeFirstname',
            'SomeLastName',
            'someEmail@somedomain.com',
            'This is a message meant for testing purposes'
        );
    }
);

$tester->define("CorrectInputProducesNoErrors", function (ContactValidationRequest $request) use ($validator) {
    $errors = $validator->validate($request);

    Assert::empty($errors);
});

// Name
$tester->define("MissingFirstNameProducesError", function (ContactValidationRequest $request) use ($validator) {
    $request->data['firstname'] = '';
    $errors = $validator->validate($request);

    Assert::notEmpty($errors);
    Assert::countEquals(1, $errors);
    Assert::contains(new ValidationError('NAME', 'FIRST_NAME_EMPTY'), $errors, false);
});


$tester->defineGroup(
    'FirstnameInvalidCharsProduceError',
    function (ContactValidationRequest $request, string $invalidFirstname) use ($validator) {
        $request->data['firstname'] = $invalidFirstname;
        $errors = $validator->validate($request);

        Assert::notEmpty($errors);
        Assert::countEquals(1, $errors);
        Assert::contains(new ValidationError('NAME', 'FIRST_NAME_UNALLOWED_CHARS'), $errors, false);
    },
    [
        new TestCase('Numbers', 'Invalid77Firstname'),
        new TestCase('Underscore', '__InvalidFirstname'),
        new TestCase('OtherInvalidChars', 'InvalidFirstname%&')
    ]
);


$tester->define("MissingLastNameProducesError", function (ContactValidationRequest $request) use ($validator) {
    $request->data['lastname'] = '';
    $errors = $validator->validate($request);

    Assert::notEmpty($errors);
    Assert::countEquals(1, $errors);
    Assert::contains(new ValidationError('NAME', 'LAST_NAME_EMPTY'), $errors, false);
});

$tester->defineGroup(
    'LastnameInvalidCharsProduceError',
    function (ContactValidationRequest $request, string $invalidLastname) use ($validator) {
        $request->data['lastname'] = $invalidLastname;
        $errors = $validator->validate($request);

        Assert::notEmpty($errors);
        Assert::countEquals(1, $errors);
        Assert::contains(new ValidationError('NAME', 'LAST_NAME_UNALLOWED_CHARS'), $errors, false);
    },
    [
        new TestCase('Numbers', 'Invalid77Lastname'),
        new TestCase('Underscore', '__InvalidLastname'),
        new TestCase('OtherInvalidChars', 'InvalidLastname%&')
    ]
);

// Email
$tester->define("MissingEmailProducesError", function (ContactValidationRequest $request) use ($validator) {
    $request->data['email'] = '';
    $errors = $validator->validate(new ContactValidationRequest(
        'some reason',
        ['some reason', 'some other valid reason'],
        'SomeFirstName',
        'SomeLastName',
        '',
        'This is a message meant for testing purposes'
    ));

    Assert::notEmpty($errors);
    Assert::countEquals(1, $errors);
    Assert::contains(new ValidationError('EMAIL', 'EMAIL_EMPTY'), $errors, false);
});

// Message
$tester->define("SpecialCharsInMessageProduceNoError", function (ContactValidationRequest $request) use ($validator) {
    $request->data['message'] = '%&%/// Something djsfklsjalskfdj';
    $errors = $validator->validate($request);

    Assert::empty($errors);
});

$tester->define("MissingMessageProducesError", function (ContactValidationRequest $request) use ($validator) {
    $request->data['message'] = '';
    $errors = $validator->validate($request);

    Assert::notEmpty($errors);
    Assert::countEquals(1, $errors);
    Assert::contains(new ValidationError('MESSAGE', 'MESSAGE_EMPTY'), $errors, false);
});

$tester->define("ShortMessageProducesError", function (ContactValidationRequest $request) use ($validator) {
    $request->data['message'] = 'Too short';
    $errors = $validator->validate($request);

    Assert::notEmpty($errors);
    Assert::countEquals(1, $errors);
    Assert::contains(new ValidationError('MESSAGE', 'MESSAGE_TOO_SHORT'), $errors, false);
});

// Combining
$tester->define("MultipleFieldsWrongProducesMultipleErrors", function (ContactValidationRequest $request) use ($validator) {
    $request->data['message'] = 'Too short';
    $request->data['lastname'] = 'Invalid77Lastname';
    $errors = $validator->validate($request);

    Assert::countEquals(2, $errors);
    Assert::contains(new ValidationError('MESSAGE', 'MESSAGE_TOO_SHORT'), $errors, false);
    Assert::contains(new ValidationError('NAME', 'LAST_NAME_UNALLOWED_CHARS'), $errors, false);
});
