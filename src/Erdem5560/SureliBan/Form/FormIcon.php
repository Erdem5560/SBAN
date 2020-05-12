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

class FormIcon implements \JsonSerializable{
	public const IMAGE_TYPE_URL = "url";
	public const IMAGE_TYPE_PATH = "path";
	private $type;
	private $data;

	public function __construct(string $data, string $type = self::IMAGE_TYPE_URL){
	$this->type = $type;
	$this->data = $data;
	}

	public function getType() : string{
	return $this->type;
	}

	public function getData() : string{
	return $this->data;
	}

	public function jsonSerialize(){
	return [
	"type" => $this->type,
	"data" => $this->data
	  ];
	}
  }
