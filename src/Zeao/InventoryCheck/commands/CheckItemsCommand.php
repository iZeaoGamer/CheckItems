<?php 
namespace Zeao\InventoryCheck;

use muqsit\invmenu\InvMenu;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Zeao\InventoryCheck\Main;

class CheckItemsCommand extends Command{
    public function __construct(Main $plugin){
        parent::__construct("checkitems", "Checks other players inventories. (Not takeable.", "/checkitems <player>");
        $this->plugin = $plugin;
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args){
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
$inventory->setContent($player->getInventory()->getContents());
$menu->readonly();
$menu->send($player, $player->getName() . "'s items / inventory.");
return;    
}
}