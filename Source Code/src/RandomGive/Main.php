<?php

namespace RandomGive;

use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;


class Main extends PluginBase implements Listener{
	public function onLoad() {
		$this->getLogger()->info("§aThis plugin is RandomGive plugin.");
		$this->getLogger()->info("§cMade By ZINGDING.");
	}
	public function onEnable() {
		$this->getLogger()->info("§dRandomGive Plugin enabled.");
		$this->getLogger()->info("§cThis plugin's License is the ZINGDING-EULA.");
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
	}
	
	public function onDisable() {
	$this->getLogger()->emergency("§dRandomGive Plugin is Disabled.");
		}
	
	public function onPlayerMove(PlayerMoveEvent $event) {
		$player = $event->getPlayer();
		
		if ($player == null) return;
		if ($player->getLevel () == null) return;
		
		// under
		$x = ( int ) round ( $player->x - 0.5 );
		$y = ( int ) round ( $player->y - 1 );
		$z = ( int ) round ( $player->z - 0.5 );
		
		$id = $player->getLevel ()->getBlockIdAt ( $x, $y, $z );
		$data = $player->getLevel ()->getBlockDataAt ( $x, $y, $z );

		switch($id) {
			case 35:
				if($data == 1) {
					$player->getInventory()->addItem(new Item(ITEM::COOKIE, 0, 1));
					$player->sendTip(TextFormat::GRAY . "{§dGiveCookie}" . TextFormat::GREEN . "You've received a cookie!");
				}
				if($data == 4) {
					$player->getInventory()->addItem(new Item(ITEM::BREAD, 0, 1));
				}
				break;
			default:
				break;
		}
	}
}
?>
