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

declare(strict_types=1);

namespace Erdem5560\SureliBan\Form;

class MenuOption implements \JsonSerializable{

	private $text;
	private $image;

	public function __construct(string $text, ?FormIcon $image = null){
	$this->text = $text;
	$this->image = $image;
	}

	public function getText() : string{
	return $this->text;
	}

	public function hasImage() : bool{
	return $this->image !== null;
	}

	public function getImage() : ?FormIcon{
	return $this->image;
	}

	public function jsonSerialize(){
	$json = [
	"text" => $this->text
	];

	if($this->hasImage()){
	$json["image"] = $this->image;
	}

	  return $json;
	}
  }
