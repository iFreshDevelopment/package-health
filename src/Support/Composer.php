<?php

namespace IFresh\PackageHealth\Support;

class Composer
{
    public function run(string $command): string
    {
        $phpExecutable = PHP_BINARY;
        $composerExecutable = trim(shell_exec('which composer'));

        return shell_exec(sprintf('%s %s %s', $phpExecutable, $composerExecutable, $command));
    }
}
