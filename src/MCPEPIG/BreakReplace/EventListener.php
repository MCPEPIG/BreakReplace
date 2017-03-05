<?php
namespace MCPEPIG\BreakReplace;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;

class EventListener implements Listener {
    public function __construct($plugin) {
        $this->plugin = $plugin;
    }

    /**
     * @param BlockBreakEvent $event
     *
     * @priority HIGHEST
     * @ignoreCancelled true
     */
    public function onBreak(BlockBreakEvent $event) {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $item = $event->getItem();
        $drops = $event->getDrops();
        if($this->plugin->getBRStatus($player)) {
            if($item->canBePlaced()) {
                $player->getLevel()->setBlock($block, $item->getBlock(), true, true);
                if(!$player->isCreative()) {
                    $player->getInventory()->removeItem($item);
                }
                $player->getInventory()->addItem(...$drops);
                $event->setCancelled();
            }
        }
    }

}
