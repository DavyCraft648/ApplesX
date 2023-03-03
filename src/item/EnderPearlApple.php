<?php
declare(strict_types=1);

namespace DavyCraft648\ApplesX\item;

use customiesdevs\customies\item\{CreativeInventoryInfo, ItemComponentsTrait};
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\entity\Living;
use pocketmine\item\ItemIdentifier;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use function mt_rand;

class EnderPearlApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("ender_pearl_apple", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(32);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::REGENERATION(), 5 * 20, 1));
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 120 * 20, 0));
			$pos = $consumer->getPosition()->floor();
			// do we need to load chunk?
			$consumer->teleport($consumer->getWorld()->getSafeSpawn(new Vector3(mt_rand($pos->x - 10, $pos->x + 10), mt_rand($pos->y - 10, $pos->y + 10), mt_rand($pos->z - 10, $pos->z + 10))));
		}
	}

	public function getFoodRestore() : int{
		return 7;
	}
}
