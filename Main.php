<?php

namespace Test;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\server;


class Main extends PluginBase implements Listener {
   public function onEnable()
   {
       $this->getLogger()->info("Le plugin a bien été activé");
       $this->getServer()->getPluginManager()->registerEvents($this, $this);
   }

   public function onDisable()
   {
       $this->getLogger()->info("Le plugin a bien été désactivé");
   }

   public function onJoin(PlayerJoinEvent $event){
       $player = $event->getPlayer();
       $event->setJoinMessage( " ");

           if(!$player->hasPlayedBefore()){
               Server::getInstance()->broadcastMessage("§l[§e!!!§r§l]§6" . $player->getName() . "§1 s'est connecté pour la première fois sur le serveur !");
           }else{
               $player->sendMessage("ANCIEN");
               Server::getInstance()->broadcastMessage( "§e§l a rejoins le serveur");
           }
    }

    public function onQuit(PlayerQuitEvent $event) {
       $player = $event->getPlayer();

       $event->setQuitMessage( " ");
       Server::getInstance()->broadcastMessage( "§6 " . $player->getName() . " §ea quitté le serveur");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
   switch($command->getName()){
       case "bonjour":
           $name = $sender->getName();
           $sender->sendMessage("§eSalut §6$name, comment ça va ?");
           break;
           return true;

       case "bonsoir":
           $sender->sendMessage("Bonsoir");

           return true;
   }

    }


    public function blockChangedListener($data, $event){
        if($event=="player.block.touch"){
            $data["player"]->sendMessage("§eTu as touché le bloc aux coordoneés:  §6§lX:".$data["target"]->x.",  §6§lY:".$data["target"]->y.",  §6§lZ:".$data["target"]->z);
        }
    }

}