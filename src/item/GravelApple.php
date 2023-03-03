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

class GravelApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("gravel_apple", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(20);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::POISON(), 5 * 20, 1));
			if(!Main::getInstance()->getConfig()->get("enable-setblock")){
				return;
			}
			$pos = $consumer->getPosition()->floor();
			$world = $consumer->getWorld();
			for($x = ($pos->x - 2); $x <= ($pos->x + 2); $x++){
				for($z = ($pos->z - 2); $z <= ($pos->z + 2); $z++){
					for($y = ($pos->y + 6); $y <= ($pos->y + 7); $y++){
						if($world->getBlockAt($x, $y, $z)->isSameType(VanillaBlocks::AIR())){
							$world->setBlockAt($x, $y, $z, VanillaBlocks::GRAVEL());
						}
					}
				}
			}
		}
	}

	public function getFoodRestore() : int{
		return 1;
	}
}
