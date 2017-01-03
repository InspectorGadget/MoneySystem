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
					$p = $args[0];
					
					if(isset($args[1])) {
						$c = $args[1];
						$pl = $this->getServer()->getPlayer($p);
						$this->setMoney($p, $c);
						$sender->sendMessage("You have set $p's Money to $c");
							if($pl === true) {
								$pl->sendMessage("Your money has been set to $c!");
							}
					}
					
				}
				else {
					$sender->sendMessage("Usage: /setmoney {player} {amount}");
				}
				return true;
			break;
			
			case "addmoney":
				if(isset($args[0])) {
					$p = $args[0];
						
						if(isset($args[1])) {
							$c = $args[1];
							$pl = $this->getServer()->getPlayer($p);
							$this->onAdd($p, $c);
							$sender->sendMessage("You have set added $m to $p!");
								if($pl === true) {
									$n = $sender->getName();
								$pl->sendMessage("$n has added $c to your account!");
							}
						}
				}
				else {
					$sender->sendMessage("Usage: /addmoney {player} {money}");
				}
				return true;
			break;
		}
	}
	
	public function setMoney($p, $c) {
		if($this->cfg->get($p) === true) {
			$this->cfg->set($p, $c);
			$this->cfg->save();
		}
		else {
			$this->cfg->set($p, $c);
			$this->cfg->save();
		}
	}
	
	public function onAdd($p, $c) {
		$if($this->cfg->get($p) === false) {
			$pl = $this->getServer()->getPlayer($p);
			$this->cfg->set($p, $c);
			$this->cfg->save();
		}
		else {
			$this->cfg->set($p, $pl + $c);
			$this->cfg->save();
		}
	}
	
	
}
