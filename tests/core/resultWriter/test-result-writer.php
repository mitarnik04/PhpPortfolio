<?php
require_once __DIR__ . '/../test-result.php';

interface ITestResultWriter
{
    function write(TestResult $result): void;

    //TODO: Make this a general implementation in base class ? 
    /** @param array<TestResult> $results */
    function writeMany(array $results): void;

    /** @param array<TestResult> $results */
    function writeSummary(array $results): void;
}
