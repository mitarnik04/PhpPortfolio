<?php
require_once __DIR__ . '/../core/tester.php';

register_shutdown_function(function () use (&$tester) {
    $tester->run();
});

function getTester(): Tester
{
    static $tester;

    if (is_null($tester)) {
        $tester = new Tester();
    }

    return $tester;
}
