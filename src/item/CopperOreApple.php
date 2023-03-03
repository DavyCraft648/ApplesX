<?php
declare(strict_types=1);

namespace DavyCraft648\ApplesX\item;

use customiesdevs\customies\item\{CreativeInventoryInfo, ItemComponentsTrait};
use DavyCraft648\ApplesX\Main;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\{effect\EffectInstance, effect\VanillaEffects, Entity, Living};
use pocketmine\item\ItemIdentifier;
use pocketmine\network\mcpe\protocol\{AddActorPacket, PlaySoundPacket, types\entity\EntityIds,
	types\entity\PropertySyncData};
use pocketmine\player\Player;

class CopperOreApple extends \pocketmine\item\Apple implements \customiesdevs\customies\item\ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$this->initComponent("copper_ore_apple", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_CROP));
		$this->setUseDuration(20);
	}

	public function onConsume(Living $consumer) : void{
		if($consumer instanceof Player){
			$consumer->getEffects()->add(new EffectInstance(VanillaEffects::HASTE(), 30 * 20, 3));

			$pos = $consumer->getPosition()->floor();
			$world = $consumer->getWorld();
			if(Main::getInstance()->getConfig()->get("enable-block-replace")){
				for($x = ($pos->x - 1); $x <= ($pos->x + 1); $x++){
					for($z = ($pos->z - 1); $z <= ($pos->z + 1); $z++){
						for($y = ($pos->y - 3); $y <= $pos->y; $y++){
							if($world->getBlockAt($x, $y, $z)->isSameType(VanillaBlocks::STONE())){
								$world->setBlockAt($x, $y, $z, VanillaBlocks::COPPER_ORE());
							}
						}
					}
				}
			}

			if(Main::getInstance()->getConfig()->get("enable-lightning")){
				$consumer->getServer()->broadcastPackets($world->getViewersForPosition($pos), [
					PlaySoundPacket::create("ambient.weather.thunder", $pos->x, $pos->y, $pos->z, 1.0, 1.0),
					AddActorPacket::create(
						$id = Entity::nextRuntimeId(), $id,
						EntityIds::LIGHTNING_BOLT,
						$pos,
						null,
						0.0, 0.0, 0.0, 0.0,
						[],
						[],
						new PropertySyncData([], []),
						[]
					)
				]);
			}
		}
	}

	public function getFoodRestore() : int{
		return 1;
	}
}
