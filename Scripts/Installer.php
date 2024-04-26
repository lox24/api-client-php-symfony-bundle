<?php

declare(strict_types=1);

namespace lox24\bundle\api_client\Scripts;


use lox24\bundle\api_client\LOX24ApiClientBundle;

readonly final class Installer {
    public static function postInstall(): void
    {
        $configDirPath = __DIR__ . '/../../../config/';
        self::appendToBundlesPhp($configDirPath, LOX24ApiClientBundle::class);
        self::appendToBundlesPhp($configDirPath, LOX24ApiClientBundle::class);
    }

    private static function appendToBundlesPhp(string $path, string $bundleClass, array $envs = ['all' => true]): void
    {
        $path .= '/bundles.php';
        $contents = file_get_contents($path);
        if($contents === false) {
            throw new \RuntimeException('Could not read bundles.php');
        }
        $newLine = sprintf("    %s::class => %s,\n", $bundleClass, var_export($envs, true));

        if (!str_contains($contents, $newLine)) {
            $contents = str_replace("];", "$newLine];", $contents);
            file_put_contents($path, $contents);
        }
    }

    private static function createYamlConfig(string $path): void
    {
        $path .= 'packages/lox24.yaml';
        if (!file_exists($path)) {
            $contents = "parameters:\n  lox24:\n    class: MyClass\n";
            file_put_contents($path, $contents);
        }
    }

}
