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

use pocketmine\form\FormValidationException;
use pocketmine\Player;
use pocketmine\utils\Utils;

class ModalForm extends BaseForm{

	private $content;
	private $onSubmit;
	private $button1;
	private $button2;

	public function __construct(string $title, string $text, \Closure $onSubmit, string $yesButtonText = "gui.yes", string $noButtonText = "gui.no"){
	parent::__construct($title);
	$this->content = $text;
	Utils::validateCallableSignature(function(Player $player, bool $choice) : void{}, $onSubmit);
	$this->onSubmit = $onSubmit;
	$this->button1 = $yesButtonText;
	$this->button2 = $noButtonText;
	}

	public function getYesButtonText() : string{
	  return $this->button1;
	}

	public function getNoButtonText() : string{
	  return $this->button2;
	}

	final public function handleResponse(Player $player, $data) : void{
	if(!is_bool($data)){
	throw new FormValidationException("Expected bool, got " . gettype($data));
		}
	  ($this->onSubmit)($player, $data);
	}

	protected function getType() : string{
	  return "modal";
	}

	protected function serializeFormData() : array{
	return [
	"content" => $this->content,
	"button1" => $this->button1,
	"button2" => $this->button2
	  ];
	}
  }
