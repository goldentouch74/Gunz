<?php

namespace Gunz;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

  public static $instance;

  private $eventListener;

  public function onEnable(): void {

    $this->eventListener = new GunzListener($this);
    self::$instance = $this;
  }
  public function getInstance(): self {

    return self::$instance;
  }
}
