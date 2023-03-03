<?php
declare(strict_types=1);

namespace DavyCraft648\ApplesX\item;

use customiesdevs\customies\item\{CreativeInventoryInfo, ItemComponentsTrait};
use DavyCraft648\ApplesX\Main;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\entity\Living;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;

class SoulSandApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("soul_sand_apple", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(40);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::FIRE_RESISTANCE(), 15 * 20, 1));
			if(!Main::getInstance()->getConfig()->get("enable-setblock")){
				return;
			}
			$pos = $consumer->getPosition()->floor();
			$world = $consumer->getWorld();
			for($x = ($pos->x - 1); $x <= ($pos->x + 1); $x++){
				for($z = ($pos->z - 1); $z <= ($pos->z + 1); $z++){
					$world->setBlockAt($x, $pos->y - 1, $z, VanillaBlocks::SOUL_SAND());
				}
			}
			for($x = ($pos->x - 1); $x <= ($pos->x + 1); $x++){
				for($z = ($pos->z - 1); $z <= ($pos->z + 1); $z++){
					if($world->getBlockAt($x, $pos->y, $z)->isSameType(VanillaBlocks::AIR())){
						$world->setBlockAt($x, $pos->y, $z, VanillaBlocks::SOUL_FIRE());
					}
				}
			}
		}
	}

	public function getFoodRestore() : int{
		return 7;
	}
}
