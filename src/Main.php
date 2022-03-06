<?php

declare(strict_types=1);

namespace Lined\annonce;

use Lined\annonce\Command\AnnonceCommand;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    private static Main $main;

    protected function onEnable(): void {        
        $this->getServer()->getPluginManager()->registerEvents($this,$this);        
        self::$main = $this;        
        if (!file_exists($this->getDataFolder() . "Config.yml")){            
            $this->saveResource("Config.yml");        
        }        
        $this->getServer()->getCommandMap()->register("Annonce", new AnnonceCommand());  
        }
    
    public static function getInstance() : Main {        
        return self::$main;   
    }
}
