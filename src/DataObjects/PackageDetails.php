<?php

namespace IFresh\PackageHealth\DataObjects;

use Carbon\Carbon;

class PackageDetails
{
    public function __construct(
        public readonly string $name,
        public readonly string $currentVersion,
        public readonly Carbon $currentReleaseDate,
        public readonly string $latestVersion,
        public readonly Carbon $latestReleaseDate,
        public readonly string $status,
        public readonly bool $isDirectDependency,
    ) {}
}
