<?php
namespace BreakReplace;

use BreakReplace\Commands\BreakReplaceCommand;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\Player;

class Main extends PluginBase {
    public $brstatuses;
    public $brlist;

    public function onEnable() {
        $this->brstatuseslist = new Config($this->getDataFolder() . "br.yml", Config::YAML);
        $this->getServer()->getCommandMap()->register('breakreplace', new BreakReplaceCommand('breakreplace', $this));
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getLogger()->info("Enabled!");
    }

    public function loadBRStatuses() {
        foreach($this->brstatuseslist->getAll() as $name => $status) {
            $this->brstatuses[strtolower($name)] = $status;
        }
    }

    public function saveBRStatuses() {
        foreach($this->brstatuses as $name => $status) {
            $this->brstatuseslist->set($name, $status);
        }
        $this->brstatuseslist->save();
    }

    public function enableBR(Player $player) {
        $this->brstatuses[strtolower($player->getName())] = true;
        $this->saveBRStatuses();
    }

    public function disableBR(Player $player) {
        $this->brstatuses[strtolower($player->getName())] = false;
        $this->saveBRStatuses();
    }

    public function getBRStatus(Player $player) {
        if(!isset($this->brstatuses[strtolower($player->getName())]))
            return false;
        return $this->brstatuses[strtolower($player->getName())];
    }

}
