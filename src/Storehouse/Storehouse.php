<?php

namespace Storehouse;

class Storehouse {

  /**
   * PSR-0 autoloader
   */
  public static function autoload($className) {
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = dirname(__DIR__) . DIRECTORY_SEPARATOR . substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    // print $fileName."\n";

    require $fileName;
  }

  /**
   * Register PSR-0 autoloader
   */
  public static function registerAutoloader() {
    spl_autoload_register(__NAMESPACE__ . "\\Storehouse::autoload");
  }  

}
