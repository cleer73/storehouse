<?php

namespace Storehouse\Filter;

class Factory {
  static public function simple($config=[]) {
    return new \Storehouse\Filter();
  }

  static public function string($config=[]) {
    $rules = [];

    $rules['string'] = \Storehouse\Rule\Factory::string();

    if (count($config) > 0) {
      if (key_exists('min', $config) && is_integer($config['min'])) {
        $rules['min_length'] = \Storehouse\Rule\Factory::minLength($config['min']);
      }

      if (key_exists('max', $config) && is_integer($config['max'])) {
        $rules['max_length'] = \Storehouse\Rule\Factory::maxLength($config['max']);
      }
    }

    return new \Storehouse\Filter(['rules' => $rules]);
  }

  static public function integer($config=[]) {
    $rules = [];

    $rules['integer'] = \Storehouse\Rule\Factory::integer();

    if (count($config) > 0) {
      if (key_exists('min', $config) && is_integer($config['min'])) {
        $rules['min_value'] = \Storehouse\Rule\Factory::minValue($config['min']);
      }

      if (key_exists('max', $config) && is_integer($config['max'])) {
        $rules['max_value'] = \Storehouse\Rule\Factory::maxValue($config['max']);
      }
    }

    return new \Storehouse\Filter(['rules' => $rules]);
  }
}
