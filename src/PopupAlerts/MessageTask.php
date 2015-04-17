<?php

/*
 * PopupAlerts (v1.1) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 17/04/2015 09:55 AM (UTC)
 * Copyright & License: (C) 2015 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/PopupAlerts/blob/master/LICENSE)
 */

namespace PopupAlerts;

use pocketmine\scheduler\PluginTask;

class MessageTask extends PluginTask {
	
    public function __construct(Main $plugin, $message, $duration){
    	parent::__construct($plugin);
        $this->plugin = $plugin;
        $this->message = $message;
        $this->duration = $duration;
        $this->current = 0;
    }
    
    public function onRun($tick){
    	$this->plugin = $this->getOwner();
    	if($this->current <= $this->duration){
    		foreach($this->plugin->getServer()->getOnlinePlayers() as $players){
    			$players->sendPopup($this->plugin->translateColors("&", $this->message));
    		}
    	}else{
    		$this->plugin->getServer()->getScheduler()->cancelTask($this->getTaskId());
    	}
    	$this->current += 1;
    }
}
?>
