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

namespace Erdem5560\SureliBan\Menu;

use pocketmine\{Player, Server};
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;
use Erdem5560\SureliBan\Form\{Form, MenuForm, FormIcon, MenuOption};
use Erdem5560\SureliBan\Form\Element\{Dropdown, Slider, Label, Input};
use Erdem5560\SureliBan\Form\{CustomForm, CustomFormResponse};
use Erdem5560\SureliBan\SureliBan;

class Menu extends MenuForm{
	
	protected $butonlar = [
	    0 => "Ban-At",
	    1 => "Ban-Kaldır"
	];

	public function __construct(Player $oyuncu){
	parent::__construct("Süreli Ban Paneli", "Bu Menüden Oyuncu Seçerek Süreli Sunucudan Uzaklaştırabilirsiniz", 
	    [
	new MenuOption("Ban At"),
	new MenuOption("Ban Kaldır"),
		],
    function(Player $oyuncu, int $buton):void{
	$seçim = $this->butonlar[$buton];
	if($seçim == "Ban-At"){
    $oyuncu->sendForm(new BanAt($oyuncu));
	}
	if($seçim == "Ban-Kaldır"){
    $oyuncu->sendForm(new BanKaldir($oyuncu));
	  }
    });
  }
}

class BanAt extends CustomForm{
    
    public function Aktif():array{
    $oyuncular = [];
    foreach (Server::getInstance()->getOnlinePlayers() as $aktifoyuncu) {
    $oyuncular[] = $aktifoyuncu->getName();
    $this->liste = $oyuncular;
        }
      return $oyuncular;
    }

	public function __construct(Player $oyuncu){
	parent::__construct(
			"Süreli Ban At",
			[
	new Dropdown("element0","Ban Atacağın Oyuncuyu Seç",$this->Aktif()),
    new Slider("element1","Gün",0,30,1),
    new Slider("element2","Saat",0,24,1),
    new Slider("element3","Dakika",0,60,1),
    new Slider("element4","Saniye",1,60,1),
    new Input("element5", "Sebep", "Örn; Hile")
			],
	function(Player $oyuncu,CustomFormResponse $dosya):void{
    $seçilenn = $this->liste[$dosya->getInt("element0")];
    $seçilen = Server::getInstance()->getPlayer($seçilenn);  
    $günn = intval($dosya->getFloat("element1"));
    $saatt = intval($dosya->getFloat("element2"));
    $dakikaa = intval($dosya->getFloat("element3"));
    $saniyee = intval($dosya->getFloat("element4"));
    $sebep = $dosya->getString("element5");
    date_default_timezone_set('Europe/Istanbul');
	$gün = ($günn * 86400);
	$saat = ($saatt * 3600);
	$dakika = ($dakikaa * 60);
	$saniye = ($saniyee);
    $banSüre = time()+$gün+$saat+$dakika+$saniye;
    SureliBan::getAPI()->ban->set($seçilen->getName(), 
        [
        "Ban-Süre" => $banSüre,
        "Sebep" => $sebep
        ]);
    SureliBan::getAPI()->ban->save();
	$seçilen->kick(str_replace(["{GÜN}", "{SAAT}", "{DAKİKA}", "{SANİYE}", "{SEBEP}"], [$günn, $saatt, $dakikaa, $saniyee, $sebep], SureliBan::getAPI()->mesaj["Oyuncu-Ban-Mesaj"]), false);
    Server::getInstance()->broadcastMessage(str_replace(["{OYUNCU}", "{GÜN}", "{SAAT}", "{DAKİKA}", "{SANİYE}","{SEBEP}"], [$seçilen->getName(), $günn, $saatt, $dakikaa, $saniyee, $sebep], SureliBan::getAPI()->mesaj["Duyuru-Ban-Mesaj"]));
      });
    }
  }
  
class BanKaldir extends CustomForm{
    
	public function __construct(Player $oyuncu){
	parent::__construct(
			"Süreli Ban Kaldır",
			[
	new Input("element0","Banını Kaldıracağın Oyuncunun İsmini Yazın", "Örn; Erdem5560"),
			],
	function(Player $oyuncu,CustomFormResponse $dosya):void{
    $oyuncuu = $dosya->getString("element0");
	if(SureliBan::getAPI()->ban->get($oyuncuu) == null){
	$oyuncu->sendMessage(str_replace(["{OYUNCU}"], [$oyuncuu], SureliBan::getAPI()->mesaj["Banlı-Değil-Mesaj"]));
	}else{
    SureliBan::getAPI()->ban->remove($oyuncuu);
    SureliBan::getAPI()->ban->save();
    Server::getInstance()->broadcastMessage(str_replace(["{OYUNCU}"], [$oyuncuu], SureliBan::getAPI()->mesaj["Ban-Kaldır-Mesaj"]));
	    }
      });
    }
  }
