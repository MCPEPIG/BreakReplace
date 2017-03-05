<?php
namespace MCPEPIG\BreakReplace\Commands;

use pocketmine\command\defaults\VanillaCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class BreakReplaceCommand extends VanillaCommand {
    public function __construct($name, $plugin) {
        parent::__construct($name, "Toggle breakreplace", "/breakreplace");
        $this->setPermission("breakreplace.command.breakreplace");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, $currentAlias, array $args) {
        if(!$this->testPermission($sender)) {
            return true;
        }
        if(!$sender instanceof Player) {
            $sender->sendMessage("§cYou must use the command in-game.");
            return false;
        }
        if($this->plugin->getBRStatus($sender)) {
            $this->plugin->disableBR($sender);
            $sender->sendMessage("§aBreakReplace disabled.");
        } else {
            $this->plugin->enableBR($sender);
            $sender->sendMessage("§aBreakReplace enabled.");
        }
        return true;
    }

}
