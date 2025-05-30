<?php
require_once __DIR__ . '/../core/testWriter/string-test-writer.php';
require_once __DIR__ . '/../core/assert.php';
require_once __DIR__ . '/../core/tester-hub.php';

function getTester(string $suite): Tester
{
    static $testerHub;
    if (!isset($testerHub)) {
        $testerHub = new TesterHub(new StringTestWriter());

        register_shutdown_function(function () use ($testerHub) {
            $testerHub->runAll();
        });
    }

    return $testerHub->getOrCreateTester($suite);
}
