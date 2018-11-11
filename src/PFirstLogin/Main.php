<?php

namespace PFirstLogin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

public function onEnable() {
      @mkdir ( $this->getDataFolder () );
      $this->player = new Config($this->getDataFolder() . "player.yml", Config::YAML);
      $this->onoff['player'] = $this->player->getAll();
      $this->give = new Config($this->getDataFolder() . "give.yml", Config::YAML,[
      "아이템" => "433",
      "데미지" => "0",
      "갯수" => "4",
      "이름" => "§9[ §f도울의 북§9 ]§r",
      "설명" => "일반(15초) : 폭발1과 함께 전방으로 도약한다"
         ]);
         $this->g = $this->give->getAll();
         $this->getServer()->getPluginManager()->registerEvents ($this, $this);
      }

public function onJoin(PlayerJoinEvent $ev){
		$player = $ev->getPlayer();
		$name = $player->getName();
		if(!isset($this->onoff['player'][$name])){
		$player->sendMessage('처음 오신것을 환영합니다');
			$this->onoff['player'][$name] = 1;
			
			
/*
$newitem = new Item($this->g['아이템'], $this->g['데미지'], $this->g['갯수']);
				$newitem->setCustomName($this->g['이름']);
				$newitem->setLore([$this->g['설명']]);
				$player->getInventory()->addItem($newitem);
				$player->sendMessage('아이템이 지급되었습니다.');
*/
					
if( $this->g['아이템'] != '0'){
				$a = $this->g['아이템'];
				$b = $this->g['데미지'];
				$c = $this->g['갯수'];
			$newitem = new Item($a, $b, $c);
			if( $this->g['이름'] != '0'){
				$newitem->setCustomName($this->g['이름']);
				$newitem->setLore([$this->g['설명']]);
				}
				$player->getInventory()->addItem($newitem);
				$player->sendMessage('아이템이 지급되었습니다.');
				}
		    }
			$this->save();
		
}

public function save(){
		
		$this->player->setAll($this->onoff['player']);
		$this->player->save();
	
	}
	
	}
	
  ?>