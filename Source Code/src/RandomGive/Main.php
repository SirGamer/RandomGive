<?php

namespace RandomGive;

use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;


class Main extends PluginBase implements Listener{
	public $items, $config, $itemWithMeta;
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
		//#30 ~ #37까지의 라인은 hm님의 Trampoline에서 복붙해옴. 제가 직접 코드 짜는 것 보단 잘 짜신 흠님 것을 님이 보고 공부하시는 것이
		//도움이 될 듯 하여 올림. 절대 물외한인이 귀찮아서가 아님.
		//참고로 위 소스 제대로 동작할지는 미지수.
		//ㄹㅇ 노답 ㅂㄷㅂㄷ;;
		
		
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
		foreach($this->itemWithMeta as $key => $meta) {
			switch($id) {
				case $key:
					if($meta == $data) {
						$this->getInventory()->addItem(array_rand($this->items));
					}
			}
		}
	}
	public function $loadConfig(){
		$this->config = (new Config($this->getDataFolder()."config.yml", Config::YAML, ["Enable" => true]))->getAll();
		$blocks = (new Config($this->getDataFolder()."blocks.yml", Config::YAML, [0] = 35:1))->getALL();
		$items = (new Config($this->getDataFolder()."items.yml", Config::YAML, [0] = ))->getALL();
		foreach($items as $item) {
			$itemArr = explode(":", $item);
			$this->items = new Item(eval($itemArr[0]), $itemArr[1]);
		}
		foreach($blocks as $blocks) {
			$blockArr = explode(":", $block)
			$this->block[$blockArr[0]] = new Item(eval($blockArr[0]), $blockArr[1]);
		}
	}
}
?>
