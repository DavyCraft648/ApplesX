<?php
declare(strict_types=1);

namespace DavyCraft648\ApplesX\item;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CustomiesItemFactory;
use pocketmine\item\{Item, ItemIdentifier};

class CakeApple2 extends CakeApple{

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->addComponent(new IconComponent("cake_apple_2"));
	}

	public function getResidue() : Item{
		return CustomiesItemFactory::getInstance()->get("apple:cake_apple_fully_eaten");
	}
}
