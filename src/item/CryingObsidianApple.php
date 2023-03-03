<?php
declare(strict_types=1);

namespace DavyCraft648\ApplesX\item;

use customiesdevs\customies\item\{CreativeInventoryInfo, ItemComponentsTrait};
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\entity\Living;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;

class CryingObsidianApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("crying_obsidian_apple", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(60);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::REGENERATION(), 40 * 20, 1));
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::RESISTANCE(), 60 * 20, 3));
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::MINING_FATIGUE(), 20 * 20, 1));
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::STRENGTH(), 32 * 20, 2));
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 200 * 20, 1));
		}
	}

	public function getFoodRestore() : int{
		return 20;
	}
}
