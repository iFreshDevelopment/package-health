<?php

namespace IFresh\PackageHealth\Generators;

use Carbon\Carbon;
use stdClass;
use IFresh\PackageHealth\DataObjects\PackageDetails;

class PackageDetailGenerator
{
    public static function fromResponse(stdClass $response): PackageDetails
    {
        return new PackageDetails(
            $response->name,
            $response->version,
            Carbon::parse($response->{'release-date'}),
            $response->{'latest'},
            Carbon::parse($response->{'latest-release-date'}),
            $response->{'latest-status'},
            $response->{'direct-dependency'}
        );
    }
}
