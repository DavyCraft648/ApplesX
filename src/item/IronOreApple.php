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

class IronOreApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("iron_ore_apple", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(60);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::RESISTANCE(), 300 * 20, 3));
			if(!Main::getInstance()->getConfig()->get("enable-block-replace")){
				return;
			}
			$pos = $consumer->getPosition()->floor();
			$world = $consumer->getWorld();
			for($x = ($pos->x - 1); $x <= ($pos->x + 1); $x++){
				for($z = ($pos->z - 1); $z <= ($pos->z + 1); $z++){
					for($y = ($pos->y - 3); $y <= $pos->y; $y++){
						if($world->getBlockAt($x, $y, $z)->isSameType(VanillaBlocks::STONE())){
							$world->setBlockAt($x, $y, $z, VanillaBlocks::IRON_ORE());
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
