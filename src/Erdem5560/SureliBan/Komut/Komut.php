<?php

/*
      _____         _                     
     | ____|_ __ __| | ___ _ __ ___       
     |  _| | '__/ _` |/ _ \ '_ ` _ \      
     | |___| | | (_| |  __/ | | | | |     
     |_____|_|  \__,_|\___|_| |_| |_|     
          ____ ____   __    ___           
          | ___| ___| / /_  / _ \         
          |___ \___ \| '_ \| | | |        
           ___) |__) | (_) | |_| |        
          |____/____/ \___/ \___/         
           ____    _    _   _ 
          | __ )  / \  | \ | |
          |  _ \ / _ \ |  \| |
          | |_) / ___ \| |\  |
          |____/_/   \_\_| \_|
                     
                                          */

namespace Erdem5560\SureliBan\Komut;

use pocketmine\{Player, Server};
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use Erdem5560\SureliBan\Menu\Menu;
use Erdem5560\SureliBan\SureliBan;

class Komut extends PluginCommand{

    public function __construct(SureliBan $plugin){
    $this->plugin = $plugin;
    parent::__construct("sban", $plugin);
    $this->setDescription("Süreli Ban Paneli");
    }

    public function execute(CommandSender $oyuncu, string $label, array $args){
    $oyuncu->sendForm(new Menu($oyuncu));
    }
  }
