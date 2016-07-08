<?php

namespace BreakReplace;

use BreakReplace\Commands\BreakReplaceCommand;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;

class Main extends PluginBase{
	public $breakreplacestatuses = array();

	public function onEnable(){
    	$this->getServer()->getCommandMap()->register('breakreplace', new BreakReplaceCommand('breakreplace', $this));
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->getLogger()->info("Enabled!");
	}

	public function enableBreakReplace(Player $player){
		$this->breakreplacestatuses[strtolower($player->getName())] = true;
	}

	public function disableBreakReplace(Player $player){
		$this->breakreplacestatuses[strtolower($player->getName())] = false;
	}

	public function getBreakReplaceStatus(Player $player){
		if(!isset($this->breakreplacestatuses[strtolower($player->getName())])) return false;
		return true;
	}

}