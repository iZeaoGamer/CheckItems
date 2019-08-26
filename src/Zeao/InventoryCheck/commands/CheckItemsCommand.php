<?php 
namespace Zeao\InventoryCheck\commands;

use muqsit\invmenu\InvMenu;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Zeao\InventoryCheck\InventoryChecker;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class CheckItemsCommand extends Command{
    public function __construct(InventoryChecker $plugin){
        parent::__construct("checkitems", "Checks other players inventories. (Not takeable.", "/checkitems <player>");
        $this->setPermission("checkitems.inventory"); //todo implement a config option to allow permissions.
        $this->plugin = $plugin;
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$this->testPermission($sender)){
            return;
        }
        if(!isset($args[0])){
            $sender->sendMessage(TextFormat::colorize("&6Please use: &b/$commandLabel <player>"));
            return;
        }
        $player = $this->plugin->getServer()->getPlayer($args[0]);
        if(!$player instanceof Player){
            $sender->sendMessage(TextFormat::colorize("&cThis player is not online."));
            return;
        }
        $sender->sendMessage(TextFormat::colorize("&6Opening &b" . $player->getName() . "'s &6inventory."));
$menu = InvMenu::create(InvMenu::TYPE_CHEST);
$inventory = $menu->getInventory();
$inventory->setContents($player->getInventory()->getContents());
$menu->readonly();
$menu->send($player, $player->getName() . "'s items");
return;    
}
}
