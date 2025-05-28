<?php
require_once __DIR__ . '/../test-result.php';
require_once __DIR__ . '/test-result-writer.php';

class StringTestResultWriter implements ITestResultWriter
{
    public function write(TestResult $testResult): void
    {
        echo "Test: $testResult->testName" . PHP_EOL;
        echo 'Success: ' . ($testResult->isSuccess ? 'Yes' : 'No') . PHP_EOL;
        echo 'Result: ' . var_export($testResult->result, true) . PHP_EOL;
        echo 'Error: ' . ($testResult->errorMsg ?? 'None') . PHP_EOL;
        if ($testResult->isError) {
            echo 'Time: N/A' . PHP_EOL;
            if (isset($testResult->exception)) {
                $exception = $testResult->exception;
                echo 'Stacktrace: ' . $exception::class . PHP_EOL
                    . $exception->getTraceAsString();
            } else {
                echo 'Stacktrace: N/A' . PHP_EOL;
            }
        } else if (isset($testResult->time) && isset($testResult->memory)) {
            echo 'Time: ' . number_format($testResult->time * 1000, 4) . 'ms' . PHP_EOL;
            echo 'Stacktrace: N/A' . PHP_EOL;
        }
        echo str_repeat('-', 40) . "\n";
    }

    public function writeMany(array $results): void
    {
        foreach ($results as $result) {
            $this->write($result);
        }
    }
}
