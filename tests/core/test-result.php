<?php

class TestResult
{
    public readonly bool $isError;

    private function __construct(
        public readonly string $testName,
        public readonly bool $isSuccess,
        public readonly ?string $errorMsg = null,
        public readonly mixed $result = null,
        public readonly ?float $time = null,
        public readonly ?Exception $exception = null,
    ) {
        $this->isError = isset($errorMsg);
    }

    public static function success(string $testName, float $time, $result = null): TestResult
    {
        return new TestResult($testName, true, time: $time, result: $result);
    }

    public static function failiure(string $testName, string $errorMsg): TestResult
    {
        return new TestResult($testName, false, $errorMsg);
    }

    public static function failiureFromException(string $testName, Exception $exception): TestResult
    {
        return new TestResult($testName, false, $exception->getMessage(), exception: $exception);
    }
}
