<?php
declare(strict_types=1);

namespace DavyCraft648\ApplesX\item;

use customiesdevs\customies\item\component\IconComponent;
use pocketmine\item\{Item, ItemIdentifier, VanillaItems};

class CakeApple3 extends CakeApple{

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->addComponent(new IconComponent("cake_apple_3"));
	}

	public function getResidue() : Item{
		return VanillaItems::AIR();
	}
}
