<?php

namespace Storehouse;

class Row {
  private $fields = [];
  private $filter;

  public function __construct($config) {
    if (empty($config['filter'])) {
      $config['filter'] = Filter\Factory::simple();
    }

    if (empty($config['fields'])) {
      throw new Exception("A Storehouse\Row needs at least one field.");
    }

    foreach ($config['fields'] as $name => $fieldConfig) {
      try {
        $this->addField($name, $fieldConfig);
      } catch (\Storehouse\Exception $e) {
        $msg = "There was a problem adding the field `{$name}`.\n"
             . "-> {$e->getMessage()}";
        throw new \Storehouse\Exception($msg);
      }
    }

    $this->filter = $config['filter'];
  }

  public function addField($name, $config) {
    if (key_exists($name, $this->fields)) {
      throw new Exception('Cannot redefine a Storehouse\Row field.');
    }
    $typeValues = ['string', 'integer'];

    if (empty($config['type']) && empty($config['value'])) {

      $types = array();
      $values = array();
      foreach ($config as $i => $v) {
        if (in_array($i, $typeValues)) {
          $types[]  = $i;
          $values[] = $v;
          unset($config[$i]);
        }
      }

      if (count($types) == 1 && count($values) == 1) {
        $value = array_shift($values);
        $type  = array_shift($types);
      } else {
        throw new Exception("A Storehouse\Row->add() can have only one ['TYPE' => 'VALUE'] index.");
      }

      $config['value'] = $value;
    } else {
      $type = $config['type'];
    }

    $this->fields[$name] = Field\Factory::$type($name, $config);
  }

  public function __get($name) {
    if (key_exists($name, $this->fields)) {
      return $this->fields[$name];
    } else {
      throw new Exception("Field {$name} does not exist in Storehouse\Row.");
    }
  }

  public function __set($name, $value) {
    if (key_exists($name, $this->fields)) {
      return $this->fields[$name]->value = $value;
    } else {
      throw new Exception("Field {$name} does not exist in Storehouse\Row.");
    }
  }

  public function __toString() {
    $string = "[\n";

    foreach ($this->fields as $field) {
      $string .= "  {$field},\n";
    }

    $string .= "]\n";

    return $string;
  }
}
