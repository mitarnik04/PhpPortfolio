<?php

// TODO: This is only for testing the "testing logic" replace with actual tests !!

require_once __DIR__ . '/../validators/contact-validator.php';

$tester = getTester();
$validator = new ContactValidator();

$tester->define("CorrectInputProducesNoErrors", function () use ($validator) {
    $errors = $validator->validate(new ContactValidationRequest(
        'some reason',
        ['some reason'],
        'SomeFirstname',
        'SomeLastName',
        'someemail@somedomain.com',
        'This is a message meant for testing purposes'
    ));
    return 'Succeeded';
});

$tester->define('SUCCESS TESTING', fn() => true);
$tester->define('SUCCESS TESTING void', function () {});
$tester->define('ERROR TESTING', fn() => new TestError('something'));
$tester->define('ERROR TESTING EXCEPTION', fn() => throw new RuntimeException('Something')); 



// $errors = $validator->validate(new ContactValidationRequest(
    //     $reason,
    //     ['collaboration', 'freelance', 'techchat', 'other'],
    //     $firstname,
    //     $lastname,
    //     $email,
    //     $message,
    // ));