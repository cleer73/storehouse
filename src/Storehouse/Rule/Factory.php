<?php

namespace Storehouse\Rule;

class Factory {
  static public function string() {
    print "Storehouse\\Rule\\string()\n";
    return function ($value) {
      return filter_var($value, FILTER_SANITIZE_STRIPPED);
    };
  }

  static public function integer() {
    print "Storehouse\\Rule\\integer()\n";
    return function ($value) { 
      return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    };
  }

  static public function minLength($min) {
    print "Storehouse\\Rule\\minLength()\n";
    return function ($value) use ($min) {
      $len = strlen($value);
      if ($len < $min) {
        throw new \Storehouse\Exception("A minimum length of {$min} is allowed. A {$len} character string was submitted.");
      }
      return $value;
    };
  }

  static public function maxLength($max) {
    print "Storehouse\\Rule\\maxLength()\n";
    return function ($value) use ($max) {
      $len = strlen($value);
      if ($value > $max) {
        throw new \Storehouse\Exception("A maximum length of {$max} is allowed. A {$len} character string was submitted.");
      }
      return $value;
    };
  }

  static public function minValue($min) {
    print "Storehouse\\Rule\\minValue()\n";
    return function ($value) use ($min) {
      if ($value < $min) {
        throw new \Storehouse\Exception("A minimum value of {$min} is allowed.");
      }
      return $value;
    };
  }

  static public function maxValue($max) {
    print "Storehouse\\Rule\\maxValue()\n";
    return function ($value) use ($max) {
      if ($value > $max) {
        throw new \Storehouse\Exception("A maximum value of {$max} is allowed.");
      }
      return $value;
    };
  }
}
