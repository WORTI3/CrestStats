<?php

declare(strict_types = 1);

namespace CrestStats;

use pocketmine\player\Player;

final class Session {

    private static \WeakMap $data;
    private static int $gameLevel;
    private static float $experience;
    private static float $coins;

    /**
     * @param string $owner
     * @param int $id
     */
    public function __construct(
        private string $owner,
        private int $id,
    ){
        self::$gameLevel = 0;
        self::$experience = Configuration::$experience;
        self::$coins = Configuration::$coins;
    }

    public static function get(Player $player): Session {
        self::$data ??= new \WeakMap();
        return self::$data[$player] ??= self::loadData($player);
    }

    private static function loadData(Player $player): Session {
        // todo: fetch existing data
        return new Session($player->getName(), random_int(0, 100));
    }

    /**
     * @return string
     */
    public function getOwner(): string {
        return $this->owner;
    }

    /**
     * @return int
     */
    public function getGameLevel(): int {
        return self::$gameLevel;
    }

    /**
     * @return float
     */
    public function getExperience(): float {
        return self::$experience;
    }

    /**
     * @return float
     */
    public function getCoins(): float {
        return self::$coins;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }
}