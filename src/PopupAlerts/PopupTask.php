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

use pocketmine\scheduler\PluginTask;

class PopupTask extends PluginTask {
	
    public function __construct(PopupAlerts $plugin, $message, $duration){
    	parent::__construct($plugin);
        $this->plugin = $plugin;
        $this->message = $message;
        $this->duration = $duration;
    }
    
    public function onRun($tick){
    	$this->plugin = $this->getOwner();
    	for($i = 0; $i < $this->duration * 10; $i++){
    	    $this->plugin->getServer()->broadcastPopup($this->plugin->translateColors("&", $this->message));
    	}
    	$this->plugin->getServer()->getScheduler()->cancelTask($this->getTaskId());
    }
}