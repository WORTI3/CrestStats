<?php

declare(strict_types = 1);

namespace CrestStats;

class Configuration {

    public const CURRENT_CONFIG_VERSION = "1.0.0";
    public static string $version;
    public static mixed $coins;
    public static mixed $experience;

    public function __construct(
        private array $data,
    ) {
        self::$version = self::format("config-version");
        self::$coins = self::format("starting-coins");
        self::$experience = self::format("starting-experience");
        var_dump($this);
    }

    private function format(string $key): mixed {
        $property = $this->data;
        foreach(explode(".", $key) as $part) {
            $property = $property[$part] ?? [];
        }
        return $property;
    }

}