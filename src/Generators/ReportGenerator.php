<?php

namespace IFresh\PackageHealth\Generators;

use IFresh\PackageHealth\DataObjects\Report;
use IFresh\PackageHealth\Repositories\PackageRepository;

class ReportGenerator
{
    public function __construct(
        public readonly PackageRepository $packages,
    ) {}

    public function generate(): Report
    {

        return new Report(
            $this->packages->majorUpdates(),
            $this->packages->minorUpdates(),
            $this->packages->patchUpdates(),
            $this->packages->hasVulnerabilities(),
            phpversion(),
            app()->version(),
        );
    }
}
