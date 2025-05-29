<?php
require_once __DIR__ . '/../test-result.php';
require_once __DIR__ . '/test-result-writer.php';

class StringTestResultWriter implements ITestResultWriter
{
    public function write(TestResult $testResult): void
    {
        $this->writeHeader($testResult);
        if (isset($testResult->time)) {
            echo 'Time: ' . number_format($testResult->time * 1000, 4) . 'ms' . PHP_EOL;
        } else {
            echo 'Time: N/A' . PHP_EOL;
        }

        if ($testResult->isError) {
            $this->writeStacktrace($testResult->exception ?? null);
        } else {
            echo 'Stack trace: N/A' . PHP_EOL;
        }

        echo str_repeat('-', 40) . PHP_EOL;
    }

    public function writeMany(array $results): void
    {
        foreach ($results as $result) {
            $this->write($result);
        }
    }

    public function writeSummary(array $results): void
    {
        $total = count($results);
        $successes = 0;
        $failures = 0;

        foreach ($results as $result) {
            if ($result->isError) {
                $failures++;
            } else {
                $successes++;
            }
        }

        echo PHP_EOL . str_repeat('=', 13) . " Test Summary " . str_repeat('=', 13) . PHP_EOL;
        echo "Total: {$total}" . PHP_EOL;
        echo "Succeeded: {$successes}" . PHP_EOL;
        echo "Failed: {$failures}" . PHP_EOL;
        echo str_repeat('=', 40) . PHP_EOL;
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
            echo 'Stack trace: N/A' . PHP_EOL;
        }
    }
}
