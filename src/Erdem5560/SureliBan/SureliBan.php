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

namespace Erdem5560\SureliBan;

use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase as P;
use pocketmine\event\Listener as L;
use pocketmine\utils\Config;
use Erdem5560\SureliBan\Komut\Komut;
use Erdem5560\SureliBan\Event\Event;

class SureliBan extends P implements L{
    
    public $mesaj;
    public $ban;
    private static $api;
	
	public function onLoad(){
	    self::$api = $this;
	}
	
	public static function getAPI():SureliBan{
		return self::$api;
	}

	public function onEnable(){
	$this->getServer()->getLogger()->info("Süreli Ban Aktif Edildi By (Erdem5560)");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
	$this->getServer()->getPluginManager()->registerEvents(new Event($this), $this);
    $this->getServer()->getCommandMap()->register("sban", new Komut($this));
    $this->ban = new Config($this->getDataFolder()."Ban.yml", Config::YAML);
	$this->mesaj = (new Config($this->getDataFolder()."Mesaj.yml", Config::YAML, array(
    "Oyuncu-Ban-Mesaj" => "§e» §cSunucudan Uzaklaştırıldın \n§e» §b{GÜN} §cGün §b{SAAT} §cSaat §b{DAKİKA} §cDakika §b{SANİYE} §cSaniye \n§e» §cSebep: §b{SEBEP}",
    "Duyuru-Ban-Mesaj" => "§e» §b{OYUNCU} §cAdlı Oyuncu Sunucudan Uzaklaştırıldı \n§e» §b{GÜN} §cGün §b{SAAT} §cSaat §b{DAKİKA} §cDakika §b{SANİYE} §cSaniye \n§e» §cSebep: §b{SEBEP}",
    "Giriş-Ban-Mesaj" => "§e» §cSunucudan Uzaklaştırıldın \n§e» §cKalan Süre §b{GÜN} §cGün §b{SAAT} §cSaat §b{DAKİKA} §cDakika §b{SANİYE} §cSaniye\n§e» §cSebep: §b{SEBEP}",
    "Ban-Kaldır-Mesaj" => "§e» §b{OYUNCU} §aİsimli Oyuncunun Uzaklaştırılması Kaldırıldı",
    "Banlı-Değil-Mesaj" => "§e» §b{OYUNCU} §cİsimli Oyuncu Uzaklaştırılmamış",
	  )))->getAll();
    }
  }
