<?php

declare(strict_types=1);

namespace CrestStats\Listeners;
use CrestStats\API;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class Session implements Listener {

    public function onJoin(PlayerJoinEvent $event): void {
        $session = API::getSessionFromPlayerEvent($event);
    }

    public function onQuit(PlayerQuitEvent $event): void {
        $session = API::getSessionFromPlayerEvent($event);
    }

    public function onChat(PlayerChatEvent $event): void {
        $session = API::getSessionFromPlayerEvent($event);
        $event->setMessage($event->getMessage() . " (ID " . $session->getId() . ")");
        $event->getPlayer()->sendMessage(" (ID " . $session->getOwner() . ", " . $session->getId() . ", " . $session->getCoins() . ", " . $session->getExperience() . ", " . $session->getGameLevel() . ")");
    }

}