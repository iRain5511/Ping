<?php
declare(strict_types = 1);
namespace iRain;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\item\Item;
use pocketmine\nbt\tag\ListTag;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener {
	public const PREFIX = TextFormat::YELLOW . "[Ping]" . TextFormat::DARK_GRAY. " ";

	public function onEnable() : void {
		$this->getLogger()->info(Main::PREFIX . "Plugin has been Enabled!");
	}

	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) : bool
	{
		$time = time();
		$date = date('Y-m-d');
		if ($sender instanceof Player) {
			switch ($cmd->getName()) {
				case "ping":
					$sender->sendMessage(TextFormat::RED . TextFormat::BOLD  .  "YOUR PING IS " . $sender->getPing() . "MS");
					return true;
			}
		} else {
			//Code for console
		}
	}

	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		if($player instanceof Player) {
		$player->getServer()->dispatchCommand($player, $this->getConfig()->get("ExecuteCommand"));
		}
	}

	public function onDisable() : void {
		$this->getLogger()->info(Main::PREFIX . "Plugin has been Disabled!");
	}
}
