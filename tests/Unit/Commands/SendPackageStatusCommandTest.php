<?php

namespace Tests\Unit\Commands;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use IFresh\PackageHealth\Commands\SendPackageStatusCommand;
use IFresh\PackageHealth\DataObjects\Report;
use IFresh\PackageHealth\Generators\ReportGenerator;
use IFresh\PackageHealth\Support\Decider;

class SendPackageStatusCommandTest extends \Tests\TestCase
{
    /** @test */
    public function it_sends_the_package_status_request_test()
    {
        Http::fake();

        $fakeReportData = new Report(collect(), collect(), collect(), false, '8.4');

        $this->mock(ReportGenerator::class)
            ->shouldReceive('generate')
            ->once()
            ->andReturn($fakeReportData);

        $command = new SendPackageStatusCommand;
        $command->handle();

        Http::assertSent(function (Request $request) {
            return $request->url() == 'https://monitor.ifresh.nl';
        });

    }

    /** @test */
    public function it_sends_the_package_status_request_to_other_url_test()
    {
        Http::fake();
        Config::set('health.url', 'https://foo.ifresh.nl');

        $fakeReportData = new Report(collect(), collect(), collect(), false, '8.4');

        $this->mock(ReportGenerator::class)
            ->shouldReceive('generate')
            ->once()
            ->andReturn($fakeReportData);

        $command = new SendPackageStatusCommand;
        $command->handle();

        Http::assertSent(function (Request $request) {
            return $request->url() == 'https://foo.ifresh.nl';
        });

    }

    /** @test */
    public function it_does_not_send_when_decider_returns_false_test()
    {

        $this->mock(Decider::class)
            ->shouldReceive('shouldPost')
            ->andReturn(false);

        Http::fake();

        $command = new SendPackageStatusCommand;
        $command->handle();

        Http::assertNothingSent();
    }
}
