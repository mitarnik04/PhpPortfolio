<?php

class Tester
{
    private $results = [];

    public function run(string $name, callable $test, int $iterations = 1, ...$args): void
    {
        $totalTime = 0;
        $totalMemory = 0;
        $success = true;
        $error = null;
        $lastResult = null;

        for ($i = 0; $i < $iterations; $i++) {
            $startMemory = memory_get_usage(true);
            $startTime = microtime(true);

            try {
                $result = $test(...$args);
                $lastResult = $result;
            } catch (\Throwable $e) {
                $success = false;
                $error = get_class($e) . ': ' . $e->getMessage() . "\n" . $e->getTraceAsString();
                break; // stop further iterations on error
            }

            $endTime = microtime(true);
            $endMemory = memory_get_usage(true);

            $totalTime += ($endTime - $startTime);
            $totalMemory += ($endMemory - $startMemory);
        }

        // Calculate average performance
        $avgTime = $totalTime / $iterations;
        $avgMemory = $totalMemory / $iterations;

        $this->results[] = [
            'name' => $name,
            'iterations' => $iterations,
            'success' => $success,
            'result' => $lastResult,
            'error' => $error,
            'time' => $avgTime,
            'memory' => $avgMemory,
        ];
    }

    public function displayResultsAsHtml(): void
    {
        echo <<<HTML
            <style>
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            .success { color: green; }
            .fail { color: red; }
            pre { margin: 0; }
            </style>
            <table>
                <thead>
                    <tr>
                        <th>Test</th>
                        <th>Iterations</th>
                        <th>Success</th>
                        <th>Result</th>
                        <th>Error</th>
                        <th>Avg Execution Time</th>
                        <th>Avg Memory Usage</th>
                    </tr>
                </thead>
                <tbody>
        HTML;

        foreach ($this->results as $result) {
            $success = $result['success'] ? '<span class="success">Yes</span>' : '<span class="fail">No</span>';
            $error = $result['error'] ?? '';
            $execTime = number_format($result['time'] * 1000, 4) . ' ms';
            $memoryUsage = number_format($result['memory'] / 1024, 2) . ' KB';
            $resultOutput = htmlspecialchars(var_export($result['result'], true));

            echo <<<HTML
                <tr>
                    <td>{$result['name']}</td>
                    <td>{$result['iterations']}</td>
                    <td>{$success}</td>
                    <td>
                        <pre>{$resultOutput}</pre>
                    </td>
                    <td><pre>{$error}</pre></td>
                    <td>{$execTime}</td>
                    <td>{$memoryUsage}</td>
                </tr>
            HTML;
        }

        echo <<<HTML
                </tbody>
            </table>
        HTML;
    }
}
