<?php

namespace Storehouse;

class Collection {

  private $createRow;
  private $rows;

  public function __construct($config) {
    if (isset($config['create_row']) && is_callable($config['create_row'])) {
      $this->createRow = $config['create_row'];
    } else {
      $msg = "A 'create_row' config is required when creating a new collection";
      throw new \Storehouse\Exception("\Storehouse\Collection::__construct(): {$msg}");
    }
  }

  public function add($row) {
    $this->rows[] = $this->createRow($row);
  }

  public function __toString() {
    foreach ($rows as $r) { print $r; }
  }
}
