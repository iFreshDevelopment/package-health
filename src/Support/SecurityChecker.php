<?php

namespace IFresh\PackageHealth\Support;

use Enlightn\SecurityChecker\SecurityChecker as BaseSecurityChecker;
use Illuminate\Support\Facades\File;

class SecurityChecker
{
    public function getVulnerabilities(string $lockFilePath): array
    {

        $dirName = storage_path('health-temporary/');

        if (! File::isDirectory($dirName)) {
            if (File::makeDirectory($dirName, 0777, true)) {
                File::put($dirName.'.gitignore', "*\n!.gitignore\n");
            } else {
                throw new \Exception("Cannot create directory '$dirName'..");
            }
        }

        return (new BaseSecurityChecker($dirName))->check($lockFilePath);

    }
}
