<?php
require_once __DIR__ . '/../helpers/container.php';

class SomeClass {}
class SomeOtherClass {}

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

$tester->define("RegisteringInstanceTwiceThrowsException", function ($container) {
    $container->add(SomeClass::class, new SomeClass());

    Assert::throws(fn() => $container->add(SomeClass::class, new SomeClass()), RuntimeException::class);
});

$tester->define("RegisteringInstanceAsWrongClassThrowsException", function ($container) {
    Assert::throws(fn() => $container->add(SomeClass::class, new SomeOtherClass()), RuntimeException::class);
});
