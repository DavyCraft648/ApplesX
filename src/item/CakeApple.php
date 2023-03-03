<?php
declare(strict_types=1);

namespace DavyCraft648\ApplesX\item;

use customiesdevs\customies\item\{CreativeInventoryInfo, CustomiesItemFactory, ItemComponentsTrait};
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\entity\Living;
use pocketmine\item\{Item, ItemIdentifier};
use pocketmine\player\Player;

class CakeApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("cake_apple_0", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(32);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::REGENERATION(), 20 * 20, 2));
		}
	}

	public function getResidue() : Item{
		return CustomiesItemFactory::getInstance()->get("apple:cake_apple_slightly_full");
	}

	public function getFoodRestore() : int{
		return 5;
	}
}
