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

namespace Erdem5560\SureliBan\Event;

use pocketmine\{Player, Server};
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;
use Erdem5560\SureliBan\SureliBan;

class Event implements Listener{
    
    public function Giriş(PlayerPreLoginEvent $event){
    $oyuncu = $event->getPlayer();
	$dosya = SureliBan::getAPI()->ban->get($oyuncu->getName());
	$banSüre = $dosya["Ban-Süre"];
	$sebep = $dosya["Sebep"];
	if($banSüre > time()){
	$kalan = $banSüre - time();
	$gün = floor($kalan / 86400);
	$saatSaniye = $kalan % 86400;
	$saat = floor($saatSaniye / 3600);
	$dakikaSaniye = $saatSaniye % 3600;
	$dakika = floor($dakikaSaniye / 60);
    $kalanSüre = $dakikaSaniye % 60;
    $saniye = ceil($kalanSüre);
	$oyuncu->close("", str_replace(["{GÜN}", "{SAAT}", "{DAKİKA}", "{SANİYE}","{SEBEP}"], [$gün, $saat, $dakika, $saniye, $sebep], SureliBan::getAPI()->mesaj["Giriş-Ban-Mesaj"]));
      }
    }
  }
