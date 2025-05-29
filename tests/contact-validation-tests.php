<?php
require_once __DIR__ . '/../validators/contact-validator.php';

$tester = getTester();
$validator = new ContactValidator();

function getValidRequest()
{
    return new ContactValidationRequest(
        'some reason',
        ['some reason', 'some other valid reason'],
        'SomeFirstname',
        'SomeLastName',
        'someEmail@somedomain.com',
        'This is a message meant for testing purposes'
    );
}

$tester->define("CorrectInputProducesNoErrors", function () use ($validator) {
    $errors = $validator->validate(getValidRequest());

    Assert::empty($errors);
});

// Name
$tester->define("MissingFirstNameProducesError", function () use ($validator) {
    $request = getValidRequest();
    $request->data['firstname'] = '';
    $errors = $validator->validate($request);

    Assert::notEmpty($errors);
    Assert::countEquals(1, $errors);
    Assert::contains(new ValidationError('NAME', 'FIRST_NAME_EMPTY'), $errors, false);
});


$tester->defineGroup(
    'FirstnameInvalidCharsProduceError',
    function (string $invalidFirstname) use ($validator) {
        $request = getValidRequest();

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


$tester->define("MissingLastNameProducesError", function () use ($validator) {
    $request = getValidRequest();
    $request->data['lastname'] = '';
    $errors = $validator->validate($request);

    Assert::notEmpty($errors);
    Assert::countEquals(1, $errors);
    Assert::contains(new ValidationError('NAME', 'LAST_NAME_EMPTY'), $errors, false);
});

$tester->defineGroup(
    'LastnameInvalidCharsProduceError',
    function (string $invalidLastname) use ($validator) {
        $request = getValidRequest();

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
$tester->define("MissingEmailProducesError", function () use ($validator) {
    $request = getValidRequest();
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
$tester->define("SpecialCharsInMessageProduceNoError", function () use ($validator) {
    $request = getValidRequest();
    $request->data['message'] = '%&%/// Something djsfklsjalskfdj';
    $errors = $validator->validate($request);

    Assert::empty($errors);
});

$tester->define("MissingMessageProducesError", function () use ($validator) {
    $request = getValidRequest();
    $request->data['message'] = '';
    $errors = $validator->validate($request);

    Assert::notEmpty($errors);
    Assert::countEquals(1, $errors);
    Assert::contains(new ValidationError('MESSAGE', 'MESSAGE_EMPTY'), $errors, false);
});

$tester->define("ShortMessageProducesError", function () use ($validator) {
    $request = getValidRequest();
    $request->data['message'] = 'Too short';
    $errors = $validator->validate($request);

    Assert::notEmpty($errors);
    Assert::countEquals(1, $errors);
    Assert::contains(new ValidationError('MESSAGE', 'MESSAGE_TOO_SHORT'), $errors, false);
});

// Combining
$tester->define("MultipleFieldsWrongProducesMultipleErrors", function () use ($validator) {
    $request = getValidRequest();
    $request->data['message'] = 'Too short';
    $request->data['lastname'] = 'Invalid77Lastname';
    $errors = $validator->validate($request);

    Assert::countEquals(2, $errors);
    Assert::contains(new ValidationError('MESSAGE', 'MESSAGE_TOO_SHORT'), $errors, false);
    Assert::contains(new ValidationError('NAME', 'LAST_NAME_UNALLOWED_CHARS'), $errors, false);
});
