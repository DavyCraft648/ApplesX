<?php
declare(strict_types=1);

namespace DavyCraft648\ApplesX;

use customiesdevs\customies\item\CustomiesItemFactory;
use DavyCraft648\ApplesX\item\{BookshelfApple, CactusApple, CakeApple, CakeApple1, CakeApple2, CakeApple3, CoalOreApple,
	CopperOreApple, CryingObsidianApple, DiamondOreApple, DirtApple, EmeraldOreApple, EnderPearlApple, GoldOreApple,
	GravelApple, IronOreApple, ObsidianApple, QuartzOreApple, SandApple, SoulSandApple, TNTApple};
use pocketmine\block\VanillaBlocks;
use pocketmine\crafting\{ExactRecipeIngredient, ShapedRecipe};
use pocketmine\item\VanillaItems;
use pocketmine\resourcepacks\ZippedResourcePack;
use function array_merge;

final class Main extends \pocketmine\plugin\PluginBase{

	private static Main $instance;

	public static function getInstance() : Main{
		return self::$instance;
	}

	protected function onLoad() : void{
		self::$instance = $this;
		$this->saveDefaultConfig();
		if($this->getConfig()->get("send-pack")){
			$this->saveResource("ApplesX.mcpack");
			$packManager = $this->getServer()->getResourcePackManager();
			$packManager->setResourceStack(array_merge($packManager->getResourceStack(), [new ZippedResourcePack($this->getDataFolder() . "ApplesX.mcpack")]));
			($serverForceResources = new \ReflectionProperty($packManager, "serverForceResources"))->setAccessible(true);
			$serverForceResources->setValue($packManager, true);
		}

		CustomiesItemFactory::getInstance()->registerItem(BookshelfApple::class, "apple:bookshelf_apple", "§6Bookshelf Apple \n§7Effects: \n-Spawns Bookshelf around the Player \nRegeneration II (0:05) \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(CactusApple::class, "apple:cactus_apple", "§2Cactus Apple \n§7Effects: \n-Spawns Cactus around the Player \nNausea II (0:15) \n§4Takes 7 HP when eaten \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(CakeApple::class, "apple:cake_apple_full", "§fCake Apple  \n§7Effects: \nRegeneration III (0:20) \nCan be Eaten 4 Times \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(CakeApple1::class, "apple:cake_apple_slightly_full", "§fCake Apple  \n§7Effects: \nRegeneration III (0:20) \nCan be Eaten 3 Times \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(CakeApple2::class, "apple:cake_apple_almost_fully_eaten", "§fCake Apple  \n§7Effects: \nRegeneration III (0:20) \nCan be Eaten 2 Times \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(CakeApple3::class, "apple:cake_apple_fully_eaten", "§fCake Apple  \n§7Effects: \nRegeneration III (0:20) \nCan be Eaten 1 Times \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(CoalOreApple::class, "apple:coal_ore_apple", "Coal Ore Apple \n§7Effects: \nPoison IV (0:10) \nNight Vision (2:00) \nWhen eaten the Stone around you will turn into Coal ore\n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(CopperOreApple::class, "apple:copper_ore_apple", "Copper Ore Apple \n§7Effects: \nHaste IV (0:30) \nWhen eaten the Stone around you will turn into Copper ore and Spawn Lightning\n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(CryingObsidianApple::class, "apple:crying_obsidian_apple", "§5Crying Obsidian Apple  \n§7Effects: \nRegeneration II (0:40)  \nResistance IV (1:00)  \nMining Fatigue II (0:20)  \nRegeneration II (0:40)  \nStrength III (0:32) \nNight Vision III (3:20) \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(DiamondOreApple::class, "apple:diamond_ore_apple", "Diamond Ore Apple \n§7Effects: \nResistance III (0:39) \nAbsorption III (5:00) \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(DirtApple::class, "apple:dirt_apple", "§2Dirt Apple \n§4Just Dont \nPLEASE \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(EmeraldOreApple::class, "apple:emerald_ore_apple", "Emerald Ore Apple \n§7Effects: \nHero of the Village IV (0:30) \n\nAbsorption III (5:00 \nWhen eaten it will spawn a Villager \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(EnderPearlApple::class, "apple:ender_pearl_apple", "§5Ender Pearl Apple \n§7Effects: \nRegeneration II (0:05) \nNight Vision (2:00) \nTeleports you randomly when eaten\n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(GoldOreApple::class, "apple:gold_ore_apple", "Gold Ore Apple \n§7Effects: \nAbsorption III (5:00) \nWhen eaten it will replace stone with Gold Ore\n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(GravelApple::class, "apple:gravel_apple", "§7Gravel Apple \n§4IF YOU EAT THIS \nYOU ARE WEIRD \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(IronOreApple::class, "apple:iron_ore_apple", "Iron Ore Apple  \n§7Effects: \nResistance III (5:00) \nWhen eaten it will replace stone with Iron Ore\n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(ObsidianApple::class, "apple:obsidian_apple", "§5Obsidian Apple \n§7Effects: \nRegeneration II (0:40)  \nResistance IV (1:00)  \nMining Fatigue II (0:20)  \nRegeneration II (0:40)  \nStrength III (0:32) \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(QuartzOreApple::class, "apple:quartz_ore_apple", "Quartz Ore Apple  \n§7Effects: \nFire Resistance II (2:00) \nWhen eaten it will replace Netherrack with Quartu Ore \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(SandApple::class, "apple:sand_apple", "§eSand Apple \n§4Eh \nNot too bad tbh \n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(SoulSandApple::class, "apple:soul_sand_apple", "§bSoul Sand Apple \n§7Effects: \nFire resistance (0:15) \nWhen Eaten spawns Soul Fire around you\n§aApplesX");
		CustomiesItemFactory::getInstance()->registerItem(TNTApple::class, "apple:tnt_apple", "§4Tnt Apple \n§4YOU CAN IMAGINE WHAT HAPPENS \n§aApplesX");

		$craftingManager = $this->getServer()->getCraftingManager();
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::BOOKSHELF()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:bookshelf_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::CACTUS()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:cactus_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"+X+",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaItems::WHEAT()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE()),
				"+" => new ExactRecipeIngredient(VanillaItems::EGG())
			],
			[CustomiesItemFactory::getInstance()->get("apple:cake_apple_full")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::COAL_ORE()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:coal_ore_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::COPPER_ORE()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:copper_ore_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::CRYING_OBSIDIAN()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:crying_obsidian_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::DIAMOND_ORE()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:diamond_ore_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::DIRT()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:dirt_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::EMERALD_ORE()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:emerald_ore_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaItems::ENDER_PEARL()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:ender_pearl_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::GOLD_ORE()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:gold_ore_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::GRAVEL()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:gravel_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::IRON_ORE()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:iron_ore_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::OBSIDIAN()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:obsidian_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::NETHER_QUARTZ_ORE()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:quartz_ore_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::SAND()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:sand_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"###",
				"#X#",
				"###"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaBlocks::SOUL_SAND()->asItem()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE())
			],
			[CustomiesItemFactory::getInstance()->get("apple:soul_sand_apple")]
		));
		$craftingManager->registerShapedRecipe(new ShapedRecipe(
			[
				"#+#",
				"+X+",
				"#+#"
			],
			[
				"#" => new ExactRecipeIngredient(VanillaItems::GUNPOWDER()),
				"X" => new ExactRecipeIngredient(VanillaItems::APPLE()),
				"+" => new ExactRecipeIngredient(VanillaBlocks::SAND()->asItem())
			],
			[CustomiesItemFactory::getInstance()->get("apple:tnt_apple")]
		));
	}
}
