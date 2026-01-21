<?php

namespace Tests\Unit\Generators;

use IFresh\PackageHealth\DataObjects\Report;
use IFresh\PackageHealth\Generators\ReportGenerator;
use IFresh\PackageHealth\Repositories\PackageRepository;
use IFresh\PackageHealth\Support\SecurityChecker;
use Tests\TestCase;

class ReportGeneratorTest extends TestCase
{
    /** @test */
    public function it_generates_a_report_test()
    {
        $this->mock(PackageRepository::class, function ($mock) {
            $mock->shouldReceive('majorUpdates')->once()->andReturn(collect());
            $mock->shouldReceive('minorUpdates')->once()->andReturn(collect());
            $mock->shouldReceive('patchUpdates')->once()->andReturn(collect());
        });

        $this->mock(SecurityChecker::class)
            ->shouldReceive('getVulnerabilities')
            ->once()
            ->andReturn([]);

        $report = app(ReportGenerator::class)->generate();

        $this->assertInstanceOf(Report::class, $report);
    }
}
