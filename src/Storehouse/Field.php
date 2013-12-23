<?php

namespace Storehouse;

class Field {

  private $name;
  private $mapsTo;
  private $required;
  private $default;
  private $filter;
  private $value;

  public function __construct($config) {
    if (empty($config['name'])) {
      throw new Exception("{__CLASSNAME__}::__construct() A 'name' is required.");
    }

    $this->name = $config['name'];

    $this->mapsTo = (empty($config['maps_to'])
      ? $this->name
      : $config['maps_to']);

    $this->required = (empty($config['required'])
      ? false
      : $config['required']);

    if ($this->required && is_null($config['default'])) {
      throw new Exception("Storehouse\Field->__construct() A 'default' value must be provided for the required field `{$this->name}`.");
    }

    $this->default = (empty($config['default'])
      ? null
      : $config['default']);

    $this->filter = (empty($config['filter'])
      ? Storehouse\Filter\Factory::simple($config['name'])
      : $config['filter']);

    $this->value = (empty($config['value'])
      ? $this->default
      : $this->filter->run($config['value']));
  }


  public function __set($name, $value) {
    if ($name === 'value') {
      $this->value = $this->filter->run($value);
    }
  }

  public function __get($name) {
    if($name === 'value') {
      return $this->value;
    } else {
      return null;
    }
  }

  public function __toString() {
    return "'{$this->name}/{$this->mapsTo}' => {$this->value}";
  }
}
