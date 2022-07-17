<?php

namespace SimpleJoinUI;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as MG;

use SimpleJoinUI\Event\JoinEvent;

class Loader extends PluginBase {

    private static $instance;
	
	public static function getInstance() : Loader {
		return self::$instance;
	}
	
	public function onLoad() : void {
		self::$instance = $this;
	}

    public function onEnable() : void {
        $this->getLogger()->info(MG::GREEN . "SimpleJoinUI enabled successfully, plugin made by JuanantonioVYT for MegaHost community");
        $this->getServer()->getPluginManager()->registerEvents(new JoinEvent(), $this);
        $this->saveResource("config.yml");

    }

    public function onDisable() : void {
        $this->getLogger()->info("SimpleJoinUI disabled successfully");
    }
}