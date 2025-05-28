<?php
require_once __DIR__ . '/../test-result.php';
require_once __DIR__ . '/test-result-writer.php';

class StringTestResultWriter implements ITestResultWriter
{
    public function write(TestResult $testResult): void
    {
        $this->writeHeader($testResult);

        if ($testResult->isError) {
            echo 'Time: N/A' . PHP_EOL;
            $this->writeStacktrace($testResult->exception ?? null);
        } elseif (isset($testResult->time)) {
            echo 'Time: ' . number_format($testResult->time * 1000, 4) . 'ms' . PHP_EOL;
            echo 'Stack trace: N/A' . PHP_EOL;
        }

        echo str_repeat('-', 40) . PHP_EOL;
    }

    private function writeHeader(TestResult $testResult): void
    {
        $format = "Test: %s" . PHP_EOL
            . "Success: %s" . PHP_EOL
            . "Result: %s" . PHP_EOL
            . "Error: %s" . PHP_EOL;

        printf(
            $format,
            $testResult->testName,
            $testResult->isSuccess ? 'Yes' : 'No',
            var_export($testResult->result, true),
            $testResult->errorMsg ?? 'None'
        );
    }

    private function writeStacktrace(?Throwable $exception): void
    {
        if ($exception) {
            echo 'Stack trace: ' . $exception::class . PHP_EOL
                . $exception->getTraceAsString() . PHP_EOL;
        } else {
            echo 'Stacktrace: N/A' . PHP_EOL;
        }
    }

    public function writeMany(array $results): void
    {
        foreach ($results as $result) {
            $this->write($result);
        }
    }
}
