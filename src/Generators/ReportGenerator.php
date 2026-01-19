<?php

namespace IFresh\PackageHealth\Generators;

use Enlightn\SecurityChecker\SecurityChecker;
use IFresh\PackageHealth\DataObjects\Report;
use IFresh\PackageHealth\Repositories\PackageRepository;

class ReportGenerator
{
    public function __construct(
        public readonly PackageRepository $packages,
        public readonly SecurityChecker $securityChecker,
    ) {}

    public function generate(): Report
    {
        return new Report(
            $this->packages->majorUpdates(),
            $this->packages->minorUpdates(),
            $this->packages->patchUpdates(),
            filled($this->securityChecker->check(base_path('composer.lock'))),
            phpversion(),
        );
    }
}
