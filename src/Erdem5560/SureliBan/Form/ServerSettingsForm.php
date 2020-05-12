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

class ServerSettingsForm extends CustomForm{

	private $icon;

	public function __construct(string $title, array $elements, ?FormIcon $icon, \Closure $onSubmit, ?\Closure $onClose = null){
	parent::__construct($title, $elements, $onSubmit, $onClose);
	  $this->icon = $icon;
	}

	public function hasIcon() : bool{
	  return $this->icon !== null;
	}

	public function getIcon() : ?FormIcon{
	  return $this->icon;
	}

	protected function serializeFormData() : array{
	$data = parent::serializeFormData();
	if($this->hasIcon()){
	$data["icon"] = $this->icon;
		}
	  return $data;
	}
  }
