<?php

namespace IFresh\PackageHealth\DataObjects;

use Illuminate\Support\Collection;

class Report
{
    /**
     * @param  Collection<PackageDetails>  $majorUpdates
     * @param  Collection<PackageDetails>  $minorUpdates
     * @param  Collection<PackageDetails>  $patchUpdates
     */
    public function __construct(
        public readonly Collection $majorUpdates,
        public readonly Collection $minorUpdates,
        public readonly Collection $patchUpdates,
        public readonly bool $hasVulnerabilities,
        public readonly string $currentPhpVersion,
        public readonly string $currentLaravelVersion,
    ) {}
}
