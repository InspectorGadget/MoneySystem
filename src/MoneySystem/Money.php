<?php

/**
 * All rights reserved RTGNetworkkk
 * STATUS : Not Complete!
*/

namespace RTG\MoneySystem;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Money extends PluginBase implements Listener {
	
	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder());
		$this->saveResource("config.yml");
	}
	
	public function onCommmand(CommandSender $sender, Command $cmd, $label, array $args) {
		switch(strtolower($cmd->getName())) {
			
			case "setmoney":
				if(isset($args[0])) {
					$w = $args[0];
					
					if(isset($args[1])) {
						$m = $args[1];
						$p = $this->getServer()->getPlayer($w);
						$this->addMoney($w, $m);
						$sender->sendMessage("You have set $w's Money to $m");
							if($p === true) {
								$p->sendMessage("Your money has been set to $m!");
							}
					}
					
				}
				
				
				
				
				return true;
			break;
		}
	}
	
	public function addMoney($p, $c) {
		if($this->cfg->get($p) === true) {
			$this->cfg->set($p, $c);
			$this->cfg->save();
		}
		else {
			$this->cfg->set($p, $c);
			$this->cfg->save();
		}
	}
	
	
}
