<?php
require_once __DIR__ . '/../core/tester.php';
require_once __DIR__ . '/../core/test-failed-exception.php';
require_once __DIR__ . '/../core/resultWriter/string-test-result-writer.php';
register_shutdown_function(function () use (&$tester) {
    $tester->run();
});

function getTester(): Tester
{
    static $tester;

    if (is_null($tester)) {
        $tester = new Tester(new StringTestResultWriter());
    }

    return $tester;
}
