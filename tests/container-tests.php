<?php
require_once __DIR__ . '/../helpers/container.php';

class SomeClass {}

$tester = getTester("Container");

$tester->setUp(fn() => new Container());

$tester->define("RegisteredInstanceCanBeRetrieved", function ($container) {
    $container->add(SomeClass::class, new SomeClass());

    $instance = $container->get(SomeClass::class);

    Assert::instanceOf(SomeClass::class, $instance);
});

$tester->define("UnregisteredInstanceThrowsException", function ($container) {
    Assert::throws(fn() => $container->get(SomeClass::class), RuntimeException::class);
});
