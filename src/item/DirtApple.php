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

class DirtApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("dirt_apple", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(32);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::POISON(), 5, 1));
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::HUNGER(), 120, 0));
			if(!Main::getInstance()->getConfig()->get("enable-setblock")){
				return;
			}
			$pos = $consumer->getPosition()->floor();
			$world = $consumer->getWorld();
			for($x = ($pos->x - 3); $x <= ($pos->x + 3); $x++){
				for($z = ($pos->z - 3); $z <= ($pos->z + 3); $z++){
					for($y = $pos->y; $y <= ($pos->y + 3); $y++){
						if(($x !== $pos->x || $z !== $pos->z || $y > ($pos->y + 1)) && $world->getBlockAt($x, $y, $z)->isSameType(VanillaBlocks::AIR())){
							$world->setBlockAt($x, $y, $z, VanillaBlocks::DIRT());
						}
					}
				}
			}
		}
	}
}
