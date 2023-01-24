<?php

declare(strict_types = 1);

namespace CrestStats;

use pocketmine\event\player\PlayerEvent;

class API {

    public static function getSessionFromPlayerEvent(PlayerEvent $event): Session {
        $player = $event->getPlayer();
        return Session::get($player);
    }

    public static function updateConfigFile(Loader $loader): void {
        @unlink($loader->getDataFolder() . "config.yml.old");
        @rename($loader->getDataFolder() . "config.yml", $loader->getDataFolder() . "config.yml.old");

        $loader->saveResource("config.yml", true);
        $loader->getConfig()->reload();
        $loader->getLogger()->notice("Config has been updated. Old config was renamed to 'config.yml.old'.");
    }

}