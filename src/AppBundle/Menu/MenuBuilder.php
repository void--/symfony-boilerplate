<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder {

  private $factory;

  public function __construct(FactoryInterface $factory) {
    $this->factory = $factory;
  }

  public function createMainMenu(array $options) {
    $menu = $this->factory->createItem('main');

    $menu->addChild('Home', ['route' => 'homepage']);
    $menu->addChild('About', ['route' => 'about']);

    return $menu;
  }

  public function createFooterMenu(array $options) {
    $menu = $this->factory->createItem('footer');

    $menu->addChild('Home', ['route' => 'homepage']);

    return $menu;
  }
}