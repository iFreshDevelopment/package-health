<?php

namespace IFresh\PackageHealth\Repositories;

use Illuminate\Support\Collection;
use stdClass;
use IFresh\PackageHealth\DataObjects\PackageDetails;
use IFresh\PackageHealth\Generators\PackageDetailGenerator;
use IFresh\PackageHealth\Support\Composer;

class PackageRepository
{
    public function __construct(
        public Composer $composer,
    ) {}

    /**
     * @return Collection<PackageDetails>
     */
    public function getWithArguments(string $parameter): Collection
    {
        $command = sprintf('outdated --format json %s', $parameter);

        $result = $this->composer->run($command);

        $collection = collect(json_decode($result)->installed);

        return $collection
            ->map(function (stdClass $package) {
                return PackageDetailGenerator::fromResponse($package);
            });

    }

    /**
     * @return Collection<PackageDetails>
     */
    public function majorUpdates(): Collection
    {
        return $this->getWithArguments('--major-only');
    }

    /**
     * @return Collection<PackageDetails>
     */
    public function minorUpdates(): Collection
    {
        return $this->getWithArguments('--minor-only');
    }

    /**
     * @return Collection<PackageDetails>
     */
    public function patchUpdates(): Collection
    {
        return $this->getWithArguments('--patch-only');
    }
}
