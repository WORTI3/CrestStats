<?php

declare(strict_types = 1);

namespace CrestStats;

use pocketmine\plugin\PluginBase;

class Loader extends PluginBase {

    public static Configuration $configuration;

    public function onEnable(): void {
        $this->loadConfig();
        $this->getServer()->getPluginManager()->registerEvents(new Listeners\Session(), $this);
    }

    private function loadConfig(): void {
        $configuration = $this->getConfig()->getAll();
        if(!array_key_exists("config-version", $configuration) || !is_string($version = $configuration["config-version"]) || version_compare($version, Configuration::CURRENT_CONFIG_VERSION) < 0) {
            API::updateConfigFile($this);
        }
        self::$configuration = new Configuration($this->getConfig()->getAll());
    }

}