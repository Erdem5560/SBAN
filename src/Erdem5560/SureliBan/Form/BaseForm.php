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

use pocketmine\form\Form;

abstract class BaseForm implements Form{

	protected $title;

	public function __construct(string $title){
 	  $this->title = $title;
	}

	public function getTitle() : string{
	  return $this->title;
	}

	final public function jsonSerialize() : array{
	$ret = $this->serializeFormData();
	$ret["type"] = $this->getType();
	$ret["title"] = $this->getTitle();
	return $ret;
	}

	abstract protected function getType() : string;

	abstract protected function serializeFormData() : array;
  }
