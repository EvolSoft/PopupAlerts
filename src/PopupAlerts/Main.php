<?php

/*
 * PopupAlerts (v1.1) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 17/04/2015 09:54 AM (UTC)
 * Copyright & License: (C) 2015 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PopupAlerts/blob/master/LICENSE)
 */

namespace PopupAlerts;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

//CustomAlerts API
use CustomAlerts\CustomAlertsAPI;
use CustomAlerts\Events\CustomAlertsDeathEvent;
use CustomAlerts\Events\CustomAlertsJoinEvent;
use CustomAlerts\Events\CustomAlertsQuitEvent;
use CustomAlerts\Events\CustomAlertsWorldChangeEvent;

class Main extends PluginBase {
    
	//About Plugin Const
	
	/** @var string PRODUCER Plugin producer */
	const PRODUCER = "EvolSoft";
	
	/** @var string VERSION Plugin version */
	const VERSION = "1.1";
	
	/** @var string MAIN_WEBSITE Plugin producer website */
	const MAIN_WEBSITE = "http://www.evolsoft.tk";
	
	//Other Const
	
	/** @var string PREFIX Plugin prefix */
	const PREFIX = "&1[&bPopup&aAlerts&1] ";
	
	/**
	 * Translate Minecraft colors
	 *
	 * @param char $symbol Color symbol
	 * @param string $message The message to be translated
	 *
	 * @return string The translated message
	 */
	public function translateColors($symbol, $message){
	
		$message = str_replace($symbol."0", TextFormat::BLACK, $message);
		$message = str_replace($symbol."1", TextFormat::DARK_BLUE, $message);
		$message = str_replace($symbol."2", TextFormat::DARK_GREEN, $message);
		$message = str_replace($symbol."3", TextFormat::DARK_AQUA, $message);
		$message = str_replace($symbol."4", TextFormat::DARK_RED, $message);
		$message = str_replace($symbol."5", TextFormat::DARK_PURPLE, $message);
		$message = str_replace($symbol."6", TextFormat::GOLD, $message);
		$message = str_replace($symbol."7", TextFormat::GRAY, $message);
		$message = str_replace($symbol."8", TextFormat::DARK_GRAY, $message);
		$message = str_replace($symbol."9", TextFormat::BLUE, $message);
		$message = str_replace($symbol."a", TextFormat::GREEN, $message);
		$message = str_replace($symbol."b", TextFormat::AQUA, $message);
		$message = str_replace($symbol."c", TextFormat::RED, $message);
		$message = str_replace($symbol."d", TextFormat::LIGHT_PURPLE, $message);
		$message = str_replace($symbol."e", TextFormat::YELLOW, $message);
		$message = str_replace($symbol."f", TextFormat::WHITE, $message);
	
		$message = str_replace($symbol."k", TextFormat::OBFUSCATED, $message);
		$message = str_replace($symbol."l", TextFormat::BOLD, $message);
		$message = str_replace($symbol."m", TextFormat::STRIKETHROUGH, $message);
		$message = str_replace($symbol."n", TextFormat::UNDERLINE, $message);
		$message = str_replace($symbol."o", TextFormat::ITALIC, $message);
		$message = str_replace($symbol."r", TextFormat::RESET, $message);
	
		return $message;
	}
	
    public function onEnable(){
    	$this->logger = Server::getInstance()->getLogger();
    	if($this->getServer()->getPluginManager()->getPlugin("CustomAlerts")){
    		if(CustomAlertsAPI::getAPI()->getAPIVersion() == "1.0"){
    			@mkdir($this->getDataFolder());
    			$this->saveDefaultConfig();
    			$this->logger->info($this->translateColors("&", Main::PREFIX . "&ePopupAlerts &9v" . Main::VERSION . " &adeveloped by&9 " . Main::PRODUCER));
    			$this->logger->info($this->translateColors("&", Main::PREFIX . "&eWebsite &9" . Main::MAIN_WEBSITE));
    			//Register this plugin as CustomAlerts extension (with lowest priority)
    			CustomAlertsAPI::getAPI()->registerExtension($this, CustomAlertsAPI::PRIORITY_LOWEST);
    		}else{
    			$this->logger->error($this->translateColors("&", Main::PREFIX . "&cPlease use CustomAlerts (API 1.0). Plugin disabled"));
    			$this->getServer()->getPluginManager()->disablePlugin($this);
    		}
    	}else{
    		$this->logger->error($this->translateColors("&", Main::PREFIX . "&cYou need to install CustomAlerts (API 1.0). Plugin disabled"));
    	}
    }
    
    public function onCustomAlertsJoinEvent(CustomAlertsJoinEvent $event){
    	$cfg = $this->getConfig()->getAll();
    	$player = $event->getPlayer();
    	if($cfg["Join"]["show-popup"] == true){
    		$msg = CustomAlertsAPI::getAPI()->getJoinMessage();
    		$this->getServer()->getScheduler()->scheduleRepeatingTask(new MessageTask($this, $msg, $cfg["Join"]["duration"]), 10);
    		if($cfg["Join"]["hide-default"] == true){
    			CustomAlertsAPI::getAPI()->setJoinMessage("");
    		}
    	}
    }
    
    public function onCustomAlertsQuitEvent(CustomAlertsQuitEvent $event){
    	$cfg = $this->getConfig()->getAll();
    	$player = $event->getPlayer();
    	if($cfg["Quit"]["show-popup"] == true){
    		$msg = CustomAlertsAPI::getAPI()->getQuitMessage();
    		$this->getServer()->getScheduler()->scheduleRepeatingTask(new MessageTask($this, $msg, $cfg["Quit"]["duration"]), 10);
    		if($cfg["Quit"]["hide-default"] == true){
    			CustomAlertsAPI::getAPI()->setQuitMessage("");
    		}
    	}
    }
    
    public function onCustomAlertsWorldChangeEvent(CustomAlertsWorldChangeEvent $event){
    	if(CustomAlertsAPI::getAPI()->isDefaultWorldChangeMessageEnabled()){
    		$cfg = $this->getConfig()->getAll();
    		$player = $event->getPlayer();
    		if($cfg["WorldChange"]["show-popup"] == true){
    			$msg = CustomAlertsAPI::getAPI()->getWorldChangeMessage();
    			$this->getServer()->getScheduler()->scheduleRepeatingTask(new MessageTask($this, $msg, $cfg["WorldChange"]["duration"]), 10);
    			if($cfg["WorldChange"]["hide-default"] == true){
    				CustomAlertsAPI::getAPI()->setWorldChangeMessage("");
    			}
    		}
    	}
    }
    
    public function onCustomAlertsDeathEvent(CustomAlertsDeathEvent $event){
    	$cfg = $this->getConfig()->getAll();
    	$player = $event->getPlayer();
    	if($cfg["Death"]["show-popup"] == true){
    		$msg = CustomAlertsAPI::getAPI()->getDeathMessage();
    		$this->getServer()->getScheduler()->scheduleRepeatingTask(new MessageTask($this, $msg, $cfg["Death"]["duration"]), 10);
    		if($cfg["Death"]["hide-default"] == true){
    			CustomAlertsAPI::getAPI()->setDeathMessage("");
    		}
    	}
    }
    
}
?>
