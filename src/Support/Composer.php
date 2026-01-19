<?php

namespace IFresh\PackageHealth\Support;

class Composer
{
    public function run(string $command): string
    {
        return shell_exec(sprintf('composer %s', $command));
    }
}
