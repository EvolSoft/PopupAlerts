<?php

/*
 * PopupAlerts (v1.4) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: https://www.evolsoft.tk
 * Date: 13/01/2018 02:03 PM (UTC)
 * Copyright & License: (C) 2015-2018 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PopupAlerts/blob/master/LICENSE)
 */

namespace PopupAlerts;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

//CustomAlerts API
use CustomAlerts\CustomAlerts;
use CustomAlerts\Events\CustomAlertsDeathEvent;
use CustomAlerts\Events\CustomAlertsJoinEvent;
use CustomAlerts\Events\CustomAlertsQuitEvent;
use CustomAlerts\Events\CustomAlertsWorldChangeEvent;

class PopupAlerts extends PluginBase implements Listener {
	
	/** @var string */
	const PREFIX = "&1[&bPopup&aAlerts&1] ";
	
	/** @var mixed[] */
	private $cfg;
	
	/**
	 * Translate Minecraft colors
	 * 
	 * @param string $symbol
	 * @param string $message
	 * 
	 * @return string
	 */
	public function translateColors($symbol, $message){
	    $message = str_replace($symbol . "0", TextFormat::BLACK, $message);
	    $message = str_replace($symbol . "1", TextFormat::DARK_BLUE, $message);
	    $message = str_replace($symbol . "2", TextFormat::DARK_GREEN, $message);
	    $message = str_replace($symbol . "3", TextFormat::DARK_AQUA, $message);
	    $message = str_replace($symbol . "4", TextFormat::DARK_RED, $message);
	    $message = str_replace($symbol . "5", TextFormat::DARK_PURPLE, $message);
	    $message = str_replace($symbol . "6", TextFormat::GOLD, $message);
	    $message = str_replace($symbol . "7", TextFormat::GRAY, $message);
	    $message = str_replace($symbol . "8", TextFormat::DARK_GRAY, $message);
	    $message = str_replace($symbol . "9", TextFormat::BLUE, $message);
	    $message = str_replace($symbol . "a", TextFormat::GREEN, $message);
	    $message = str_replace($symbol . "b", TextFormat::AQUA, $message);
	    $message = str_replace($symbol . "c", TextFormat::RED, $message);
	    $message = str_replace($symbol . "d", TextFormat::LIGHT_PURPLE, $message);
	    $message = str_replace($symbol . "e", TextFormat::YELLOW, $message);
	    $message = str_replace($symbol . "f", TextFormat::WHITE, $message);
	    
	    $message = str_replace($symbol . "k", TextFormat::OBFUSCATED, $message);
	    $message = str_replace($symbol . "l", TextFormat::BOLD, $message);
	    $message = str_replace($symbol . "m", TextFormat::STRIKETHROUGH, $message);
	    $message = str_replace($symbol . "n", TextFormat::UNDERLINE, $message);
	    $message = str_replace($symbol . "o", TextFormat::ITALIC, $message);
	    $message = str_replace($symbol . "r", TextFormat::RESET, $message);
	    return $message;
	}
	
    public function onEnable(){
    	$this->logger = $this->getServer()->getLogger();
    	if($this->getServer()->getPluginManager()->getPlugin("CustomAlerts")){
    		if(CustomAlerts::getAPI()->getAPIVersion() == "2.0"){
    			@mkdir($this->getDataFolder());
    			$this->saveDefaultConfig();
    			$this->cfg = $this->getConfig()->getAll();
				$this->getServer()->getPluginManager()->registerEvents($this, $this);
    			$this->logger->info($this->translateColors("&", self::PREFIX . "&ePopupAlerts &9v" . $this->getDescription()->getVersion() . "&e developed by &9EvolSoft"));
    			$this->logger->info($this->translateColors("&", self::PREFIX . "&eWebsite &9" . $this->getDescription()->getWebsite()));
    		}else{
    			$this->logger->error($this->translateColors("&", self::PREFIX . "&cPlease update CustomAlerts to API 2.0. Plugin disabled"));
    			$this->getServer()->getPluginManager()->disablePlugin($this);
    		}
    	}else{
    		$this->logger->error($this->translateColors("&", self::PREFIX . "&cYou need to install CustomAlerts (API 2.0). Plugin disabled"));
    	}
    }
    
    public function onCAJoin(CustomAlertsJoinEvent $event){
    	$player = $event->getPlayer();
    	if($this->cfg["Join"]["show-popup"]){
    		$msg = $event->getMessage();
    		$this->getServer()->getScheduler()->scheduleTask(new PopupTask($this, $msg, $this->cfg["Join"]["duration"]));
    		if($this->cfg["Join"]["hide-default"]){
    			$event->setMessage("");
    		}
    	}
    }
    
    public function onCAQuit(CustomAlertsQuitEvent $event){
    	$player = $event->getPlayer();
    	if($this->cfg["Quit"]["show-popup"]){
    		$msg = $event->getMessage();
    		$this->getServer()->getScheduler()->scheduleTask(new PopupTask($this, $msg, $this->cfg["Quit"]["duration"]));
    		if($this->cfg["Quit"]["hide-default"]){
    			$event->setMessage("");
    		}
    	}
    }
    
    public function onCAWorldChange(CustomAlertsWorldChangeEvent $event){
    	if(CustomAlerts::getAPI()->isWorldChangeMessageEnabled()){
    		$player = $event->getPlayer();
    		if($this->cfg["WorldChange"]["show-popup"]){
    			$msg = $event->getMessage();
    			$this->getServer()->getScheduler()->scheduleTask(new PopupTask($this, $msg, $this->cfg["WorldChange"]["duration"]));
    			if($this->cfg["WorldChange"]["hide-default"]){
    				$event->setMessage("");
    			}
    		}
    	}
    }
    
    public function onCADeath(CustomAlertsDeathEvent $event){
    	$player = $event->getPlayer();
    	if($this->cfg["Death"]["show-popup"]){
    		$msg = $event->getMessage();
    		$this->getServer()->getScheduler()->scheduleTask(new PopupTask($this, $msg, $this->cfg["Death"]["duration"]));
    		if($this->cfg["Death"]["hide-default"]){
    			$event->setMessage("");
    		}
    	}
    }
}