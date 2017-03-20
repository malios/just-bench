<?php declare(strict_types=1);

namespace JustBench;

use JustBench\Exception\BenchmarkException;

final class Benchmark
{
    /**
     * @var float
     */
    private $startTime;

    /**
     * @var float
     */
    private $endTime;

    /**
     * @var int
     */
    private $peakUsageStart;

    /**
     * @var int
     */
    private $peakUsageEnd;

    /**
     * Start benchmark
     *
     * @return void
     * @throws BenchmarkException
     */
    public function start()
    {
        if ($this->startTime !== null) {
            throw new BenchmarkException('Benchmark is already started.');
        }

        $this->startTime = microtime(true);
        $this->peakUsageStart = memory_get_peak_usage(true);
    }

    /**
     * Stop benchmark
     *
     * @return void
     * @throws BenchmarkException
     */
    public function stop()
    {
        if ($this->startTime === null) {
            throw new BenchmarkException('Benchmark is not started.');
        }

        if ($this->endTime !== null) {
            throw new BenchmarkException('Benchmark is already stopped.');
        }

        $this->endTime = microtime(true);
        $this->peakUsageEnd = memory_get_peak_usage(true);
    }

    /**
     * Get elapsed time
     *
     * @return float
     * @throws BenchmarkException
     */
    public function getElapsedTime() : float
    {
        if ($this->endTime === null) {
            throw new BenchmarkException('Cannot get elapsed time, benchmark is not stopped.');
        }

        $elapsedTime = ($this->endTime - $this->startTime);
        return $elapsedTime;
    }

    /**
     * Get memory peak usage
     *
     * @return int
     */
    public function getMemoryPeakUsage() : int
    {
        return $this->peakUsageEnd - $this->peakUsageStart;
    }
}
