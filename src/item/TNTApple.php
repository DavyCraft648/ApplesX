<?php
declare(strict_types=1);

namespace DavyCraft648\ApplesX\item;

use customiesdevs\customies\item\{CreativeInventoryInfo, ItemComponentsTrait};
use DavyCraft648\ApplesX\Main;
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\entity\Living;
use pocketmine\event\entity\EntityPreExplodeEvent;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;
use pocketmine\world\Explosion;

class TNTApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("tnt_apple", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(8);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::RESISTANCE(), 6 * 20, 30));
			if(!Main::getInstance()->getConfig()->get("enable-explosion")){
				return;
			}
			$ev = new EntityPreExplodeEvent($consumer, 4); // this should be a crystal
			$ev->call();
			if(!$ev->isCancelled()){
				$explosion = new Explosion($consumer->getPosition(), $ev->getRadius());
				if($ev->isBlockBreaking()){
					$explosion->explodeA();
				}
				$explosion->explodeB();
			}
		}
	}

	public function getFoodRestore() : int{
		return 7;
	}
}
