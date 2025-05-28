<?php
require_once __DIR__ . '/test.php';
require_once __DIR__ . '/test-result.php';


class Tester
{
    /** @var array<TestResult> */
    private array $results = [];

    /** @var array<Test> */
    private array $tests = [];

    public function define(string $name, callable $test, ...$args): void
    {
        $this->tests[] = new Test($name, $test, $args);
    }

    public function run(): void
    {
        foreach ($this->tests as $test) {
            $testResult = $this->runSingleTest($test);
            $this->results[] = $testResult;
        }

        $this->displayResults();

        exit($this->hasFailures() ? 1 : 0);
    }

    private function runSingleTest(Test $test): TestResult
    {
        try {
            $startMemory = memory_get_usage();
            $startTime = microtime(true);

            $result = ($test->testCallable)(...$test->args);

            $endTime = microtime(true);
            $endMemory = memory_get_usage();

            if ($result instanceof TestError) {
                return TestResult::Failiure($test->name, $result->message);
            }
            $time = $endTime - $startTime;
            $memory = $endMemory - $startMemory;
            return TestResult::SuccessWithMetrics($test->name, $time, $memory, $result);
        } catch (\Throwable $e) {
            return TestResult::Failiure($test->name, get_class($e) . ': ' . $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }

    private function displayResults(): void
    {
        foreach ($this->results as $result) {
            echo "Test: $result->testName" . PHP_EOL;
            echo 'Success: ' . ($result->isSuccess ? 'Yes' : 'No') . PHP_EOL;
            echo 'Result: ' . var_export($result->result, true) . PHP_EOL;
            echo 'Error: ' . ($result->errorMsg ?? 'None') . PHP_EOL;
            if ($result->isError) {
                echo 'Time: N/A' . PHP_EOL;
                echo 'Memory: N/A' . PHP_EOL;
            } else if (isset($result->time) && isset($result->memory)) {
                echo 'Time: ' . number_format($result->time * 1000, 4) . " ms\n";
                echo 'Memory: ' . number_format($result->memory / 1024, 2) . " KB\n";
            }
            echo str_repeat('-', 40) . "\n";
        }
    }

    private function hasFailures(): bool
    {
        foreach ($this->results as $result) {
            if ($result->isError) {
                return true;
            }
        }
        return false;
    }
}
