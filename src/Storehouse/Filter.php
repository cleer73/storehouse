<?php

namespace Storehouse;

class Filter {

  private $rules = array();

  public function __construct($config=[]) {
    if (!empty($config['rules'])) {
      foreach ($config['rules'] as $name => $callback) {
        $this->addRule($name, $callback);
      }
    } else {
      $this->addRule('passthru', function ($value) { return $value; });
    }
  }

  public function run($value) {
    foreach ($this->rules as $rule) {
      $value = $rule($value);
    }
    return $value;
  }

  public function addRule($name, $callback) {
    if (is_string($name) && is_callable($callback)) {
      $this->rules[$name] = $callback;
      return true;
    } else {
      return false;
    }
  }
}
