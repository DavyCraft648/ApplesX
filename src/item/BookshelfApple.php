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

class BookshelfApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("bookshelf_apple", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(32);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::REGENERATION(), 5 * 20, 1));
			if(!Main::getInstance()->getConfig()->get("enable-setblock")){
				return;
			}
			$pos = $consumer->getPosition()->floor();
			$world = $consumer->getWorld();
			for($x = ($pos->x - 2); $x <= ($pos->x + 2); $x++){
				for($y = $pos->y; $y <= ($pos->y + 2); $y++){
					if($world->getBlockAt($x, $y, $pos->z - 2)->isSameType(VanillaBlocks::AIR())){
						$world->setBlockAt($x, $y, $pos->z - 2, VanillaBlocks::BOOKSHELF());
					}
					if($world->getBlockAt($x, $y, $pos->z + 2)->isSameType(VanillaBlocks::AIR())){
						$world->setBlockAt($x, $y, $pos->z + 2, VanillaBlocks::BOOKSHELF());
					}
				}
			}
			for($z = ($pos->z - 1); $z <= ($pos->z + 1); $z++){
				for($y = $pos->y; $y <= ($pos->y + 2); $y++){
					if($world->getBlockAt($pos->x - 2, $y, $z)->isSameType(VanillaBlocks::AIR())){
						$world->setBlockAt($pos->x - 2, $y, $z, VanillaBlocks::BOOKSHELF());
					}
					if($world->getBlockAt($pos->x + 2, $y, $z)->isSameType(VanillaBlocks::AIR())){
						$world->setBlockAt($pos->x + 2, $y, $z, VanillaBlocks::BOOKSHELF());
					}
				}
			}
		}
	}

	public function getFoodRestore() : int{
		return 7;
	}
}
