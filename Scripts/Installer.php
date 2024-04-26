<?php

declare(strict_types=1);

namespace lox24\bundle\api_client\Scripts;


use lox24\bundle\api_client\LOX24ApiClientBundle;

readonly final class Installer {
    public static function postInstall(): void
    {
        $bundlesPath = __DIR__ . '/../../../config/bundles.php';
        self::appendToBundlesPhp($bundlesPath, LOX24ApiClientBundle::class);
    }

    private static function appendToBundlesPhp(string $bundlesPath, string $bundleClass, array $envs = ['all' => true]): void
    {
        $contents = file_get_contents($bundlesPath);
        if($contents === false) {
            throw new \RuntimeException('Could not read bundles.php');
        }
        $newLine = sprintf("    %s::class => %s,\n", $bundleClass, var_export($envs, true));

        if (!str_contains($contents, $newLine)) {
            $contents = str_replace("];", "$newLine];", $contents);
            file_put_contents($bundlesPath, $contents);
        }
    }

    private static function createYamlConfig(string $bundlesPath): void
    {
        $configPath = 'path/to/config/packages/mybundle.yaml';
        if (!file_exists($configPath)) {
            $yamlContent = "services:\n  my_service:\n    class: MyClass\n";
            file_put_contents($configPath, $yamlContent);
        }
    }

}
