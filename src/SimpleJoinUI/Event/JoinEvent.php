<?php

namespace SimpleJoinUI\Event;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as MG;
use pocketmine\plugin\Plugin;

use Vecnavium\FormsUI\Form;
use Vecnavium\FormsUI\FormAPI;
use Vecnavium\FormsUI\SimpleForm;

use SimpleJoinUI\Loader;

class JoinEvent implements Listener{

    private $plugin;

    public function onJoin(PlayerJoinEvent $event){

        $this->plugin = Loader::getInstance();
        $player = $event->getPlayer();
        $name = $player->getName();
        $this->FormJoin($player);

        $event->setJoinMessage("");
            Server::getInstance()->broadcastMessage(str_replace(["{player}"], [$player->getName()], $this->plugin->getConfig()->get("Join-Message")));

    }

    public function onQuit(PlayerQuitEvent $event){

        $player = $event->getPlayer();
        $name = $player->getName();

        $event->setQuitMessage("");
        Server::getInstance()->broadcastMessage(str_replace(["{player}"], [$player->getName()], $this->plugin->getConfig()->get("Quit-Message")));
    }

    public function FormJoin(Player $player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                break;
            }
        });
        $form->setTitle(MG::RED . $this->plugin->getConfig()->get("TitleForm"));
        $form->setContent(MG::RED . $this->plugin->getConfig()->get("MessageForm"));
        $form->addButton(MG::RED . "Cerrar");
        $form->sendToPlayer($player);
    }
}