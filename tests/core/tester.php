<?php
require_once __DIR__ . '/test.php';
require_once __DIR__ . '/test-result.php';

class Tester
{
    /** @var array<TestResult> */
    private array $results = [];

    /** @var array<Test> */
    private array $tests = [];

    public function __construct(
        private ITestResultWriter $writer
    ) {}

    public function define(string $name, callable $test, ...$args): void
    {
        $this->tests[] = new Test($name, $test, $args);
    }

    public function run(): void
    {
        $this->results = array_map(fn($test) => $this->runSingleTest($test), $this->tests);

        $this->writer->writeMany($this->results);

        exit($this->hasFailures() ? 1 : 0);
    }

    private function runSingleTest(Test $test): TestResult
    {
        try {
            $startTime = microtime(true);

            $result = ($test->testCallable)(...$test->args);

            $endTime = microtime(true);

            return TestResult::success($test->name, $endTime - $startTime, $result);
        } catch (\Throwable $e) {
            return TestResult::failiureFromException($test->name, $e);
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
