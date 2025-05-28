<?php
require_once __DIR__ . '/test-error.php';


class TestResult
{
    public readonly bool $isError;

    private function __construct(
        public readonly string $testName,
        public readonly bool $isSuccess,
        public readonly ?string $errorMsg = null,
        public readonly mixed $result = null,
        public readonly ?float $time = null,
        public readonly ?int $memory = null
    ) {
        $this->isError = isset($errorMsg);
    }

    public static function Success(string $testName, $result = null)
    {
        return new TestResult($testName, true, result: $result);
    }

    public static function SuccessWithMetrics(string $testName, float $time, int $memory, $result = null,)
    {
        return new TestResult(
            $testName,
            true,
            result: $result,
            time: $time,
            memory: $memory
        );
    }

    public static function Failiure(string $testName, string $errorMsg)
    {
        return new TestResult($testName, false, $errorMsg);
    }
}
