<?php 
namespace Zeao\InventoryCheck;

use pocketmine\plugin\PluginBase;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;
use Zeao\InventoryCheck\commands\CheckItemsCommand;

class InventoryChecker extends PluginBase{
    public function onEnable(): void{
        $this->getServer()->getCommandMap()->register("checkitems", new CheckItemsCommand($this));
    if(!InvMenuHandler::isRegistered()){
        InvMenuHandler::register($this);
    }
}
}