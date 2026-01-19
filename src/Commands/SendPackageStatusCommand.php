<?php

namespace IFresh\PackageHealth\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use IFresh\PackageHealth\Generators\ReportGenerator;

class SendPackageStatusCommand extends Command
{
    protected $signature = 'health:send-package-status';

    public function handle()
    {
        $shouldPost = app()
            ->make(config('health.decider'))
            ->shouldPost();

        if ($shouldPost === false) {
            return;
        }

        $output = app(ReportGenerator::class)->generate();

        try {
            Http::withToken(config('health.api_token'))
                ->timeout(10)
                ->asJson()
                ->post(config('health.url'), $output);
        } catch (ConnectionException $exception) {
            Log::warning('Health check request failed', [
                'url' => config('health.url'),
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
