<?php 
namespace Lined\annonce\Command; 

use Lined\annonce\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\Config; 

class AnnonceCommand extends Command { 
    public function __construct() { 
        parent::__construct("annonce", "Faire une annonce", "/annonce <message>"); 
    } 
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool { 
        if (!$sender->hasPermission("annonce.use") && !Server::getInstance()->isOp($sender->GetName())) {
            $sender->sendMessage("§cYou don't have permission to use this command");
            return true; 
        } 
        if (count($args) === 0) {
            $sender->sendMessage("§cVeuillez mettre une annonce");
            return true;
        }
        $config = new Config(Main::getInstance()->getDataFolder() . "Config.yml", Config::YAML);
        $prefix = $config->get("Prefix");
        $prefix = str_replace("{name}", $sender->getName(), $prefix);
        $color = $config->get("Color");
        $msg = implode(" ", $args);
        Server::getInstance()->broadcastMessage($prefix . $color . $msg); 
        return true; 
    } 
}