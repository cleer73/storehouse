<?php

namespace Storehouse\Field;

class Factory {
  static public function string($name, $config=[]) {
    $filterConfig = [];

    if (!empty($config['min'])) {
      $filterConfig['min'] = $config['min'];
      unset($config['min']);
    }

    if (!empty($config['max'])) {
      $filterConfig['max'] = $config['max'];
      unset($config['max']);
    }

    $config['name']   = $name;
    $config['filter'] = \Storehouse\Filter\Factory::string($filterConfig);

    return new \Storehouse\Field($config);
  }

  static public function integer($name, $config=[]) {
    $filterConfig = [];

    if (!empty($config['min'])) {
      $filterConfig['min'] = $config['min'];
      unset($config['min']);
    }

    if (!empty($config['max'])) {
      $filterConfig['max'] = $config['max'];
      unset($config['max']);
    }

    $config['name']   = $name;
    $config['filter'] = \Storehouse\Filter\Factory::integer($filterConfig);

    return new \Storehouse\Field($config);
  }
}
