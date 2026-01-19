<?php

namespace Tests\Unit\Generators;

use IFresh\PackageHealth\DataObjects\PackageDetails;
use IFresh\PackageHealth\Generators\PackageDetailGenerator;
use Tests\TestCase;

use function PHPUnit\Framework\assertSame;

class PackageDetailGeneratorTest extends TestCase
{
    /** @test */
    public function it_generates_a_dataobject_test()
    {
        $sample = file_get_contents(__DIR__.'/../../Fixtures/sample.json');

        $responseObject = json_decode($sample);

        /** @var PackageDetails $result */
        $result = PackageDetailGenerator::fromResponse($responseObject);

        assertSame('theseer/tokenizer', $result->name);
        assertSame('1.3.1', $result->currentVersion);
        assertSame('17-11-2025', $result->currentReleaseDate->format('d-m-Y'));
        assertSame('2.0.1', $result->latestVersion);
        assertSame('08-12-2025', $result->latestReleaseDate->format('d-m-Y'));
    }
}
