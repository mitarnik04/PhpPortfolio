<?php
require_once __DIR__ . '/../core/tester.php';
require_once __DIR__ . '/../core/resultWriter/string-test-result-writer.php';
require_once __DIR__ . '/../core/assert.php';

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
