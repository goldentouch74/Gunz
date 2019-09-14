<?php

namespace Gunz;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\entity\projectile\Snowball;
use pocketmine\entity\Entity;
use pocketmine\item\Item;

use Gunz\Main;

class GunzListener implements Listener {

  private $plugin;

  public function __construct($plugin) {

    $plugin->getServer()->getPluginManager()->registerEvents($this, $plugin);
    $this->plugin = $plugin;
  }

  public function onInteract(PlayerInteractEvent $event) {

    $player = $event->getPlayer();
    if ($event->getItem()->getId() == Item::IRON_HOE) {

      $entity = Entity::createEntity("Snowball", $player->getLevel(), Entity::createBaseNBT($player->asVector3()->add(0, 1)));
      $entity->setMotion($player->getDirectionVector()->multiply(1.2));
      $entity->spawnToAll();
      $entity->setOwningEntity($player);
    }
  }
  public function onDamage(EntityDamageByEntityEvent $event) {

    $entity = $event->getEntity();
    $damager = $event->getDamager();

    if ($damager instanceof Snowball) {

      $attack = new EntityDamageEvent($entity, EntityDamageEvent::CAUSE_PROJECTILE, 8);
      $entity->attack($attack);
    }
  }
}
