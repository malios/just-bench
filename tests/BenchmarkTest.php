<?php

namespace Test;

use JustBench\Benchmark;
use JustBench\Exception\BenchmarkException;
use PHPUnit\Framework\TestCase;

class BenchmarkTest extends TestCase
{
    public function testStoppingBenchmarkWithoutStarting()
    {
        $this->expectException(BenchmarkException::class);
        $benchmark = new Benchmark();
        $benchmark->stop();
    }

    public function testGetElapsedTimeWithoutStopping()
    {
        $this->expectException(BenchmarkException::class);
        $benchmark = new Benchmark();
        $benchmark->start();
        $benchmark->getElapsedTime();
    }

    public function testCannotCallStartTwice()
    {
        $this->expectException(BenchmarkException::class);
        $benchmark = new Benchmark();
        $benchmark->start();
        $benchmark->start();
    }

    public function testCannotCallStopTwice()
    {
        $this->expectException(BenchmarkException::class);
        $benchmark = new Benchmark();
        $benchmark->stop();
        $benchmark->stop();
    }

    public function testElapsedTime()
    {
        $benchmark = new Benchmark();

        $benchmark->start();
        usleep(1 * 1000); // 1 millisecond
        $benchmark->stop();

        $elapsedTime = $benchmark->getElapsedTime();

        $this->assertGreaterThanOrEqual(0.001, $elapsedTime);
    }

    public function testGetMemoryPeakUsage()
    {
        $benchmark = new Benchmark();

        $benchmark->start();
        str_repeat('Test', 500000);
        $benchmark->stop();

        $this->assertGreaterThanOrEqual(0, $benchmark->getMemoryPeakUsage());
    }
}
