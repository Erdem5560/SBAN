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

class MenuForm extends BaseForm{

	protected $content;
	private $options;
	private $onSubmit;
	private $onClose = null;

	public function __construct(string $title, string $text, array $options, \Closure $onSubmit, ?\Closure $onClose = null){
	parent::__construct($title);
	$this->content = $text;
	$this->options = array_values($options);
	Utils::validateCallableSignature(function(Player $player, int $selectedOption) : void{}, $onSubmit);
	$this->onSubmit = $onSubmit;
	if($onClose !== null){
	Utils::validateCallableSignature(function(Player $player) : void{}, $onClose);
	$this->onClose = $onClose;
	  }
	}

	public function getOption(int $position) : ?MenuOption{
	return $this->options[$position] ?? null;
	}

	final public function handleResponse(Player $player, $data) : void{
	if($data === null){
	if($this->onClose !== null){
	($this->onClose)($player);
	}
	}elseif(is_int($data)){
	if(!isset($this->options[$data])){
	throw new FormValidationException("Option $data does not exist");
	}
	($this->onSubmit)($player, $data);
	}else{
    throw new FormValidationException("Expected int or null, got " . gettype($data));
	  }
	}

	protected function getType() : string{
	  return "form";
	}

	protected function serializeFormData() : array{
	return [
	"content" => $this->content,
	"buttons" => $this->options 
	  ];
	}
  }
