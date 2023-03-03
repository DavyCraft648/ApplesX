<?php
declare(strict_types=1);

namespace DavyCraft648\ApplesX\item;

use customiesdevs\customies\item\{CreativeInventoryInfo, ItemComponentsTrait};
use DavyCraft648\ApplesX\Main;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\entity\Living;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\ItemIdentifier;
use pocketmine\math\Facing;
use pocketmine\player\Player;

class CactusApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("cactus_apple", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(40);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::NAUSEA(), 15 * 20, 1));
			$consumer->attack(new EntityDamageEvent($consumer, EntityDamageEvent::CAUSE_MAGIC, 7));
			if(!Main::getInstance()->getConfig()->get("enable-setblock")){
				return;
			}
			$pos = $consumer->getPosition()->floor();
			$world = $consumer->getWorld();
			foreach(Facing::HORIZONTAL as $facing){
				$side = $pos->getSide($facing);
				$world->setBlockAt($side->x, $side->y - 1, $side->z, VanillaBlocks::SAND());
				$world->setBlockAt($side->x, $side->y, $side->z, VanillaBlocks::CACTUS());
				$world->setBlockAt($side->x, $side->y + 1, $side->z, VanillaBlocks::CACTUS());
			}
		}
	}
}
