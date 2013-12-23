<?php

set_include_path(
  realpath('./') . PATH_SEPARATOR .
  get_include_path()
);

include 'vendor/fzaninotto/faker/src/autoload.php';
include 'src/Storehouse/Storehouse.php';
Storehouse\Storehouse::registerAutoloader();

// $faker = Faker\Factory::create();
$faker = new Faker\Generator();
$faker->addProvider(new Faker\Provider\en_US\Person($faker));
$faker->addProvider(new Faker\Provider\en_US\Address($faker));
$faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
$faker->addProvider(new Faker\Provider\en_US\Company($faker));
$faker->addProvider(new Faker\Provider\Lorem($faker));
$faker->addProvider(new Faker\Provider\Internet($faker));

$rows = [];

foreach (range(1, 10) as $i) {
  $rows[] = new Storehouse\Row([
    'fields' => [
      'id'          => ['integer' => $i,                    'maps_to' => 'Id', 'required' => true, 'default' => 0],
      'first_name'  => ['string'  => $faker->firstName,     'maps_to' => 'FirstName', 'required' => true, 'default' => '_UNKNOWN_'],
      'last_name'   => ['string'  => $faker->lastName,      'maps_to' => 'LastName'],
      'address'     => ['string'  => $faker->streetAddress, 'maps_to' => 'Address'],
      'city'        => ['string'  => $faker->city,          'maps_to' => 'City'],
      'state'       => ['string'  => $faker->state,         'maps_to' => 'State'],
      'postal_code' => ['string'  => $faker->postcode,      'maps_to' => 'PostalCode'],
      'country'     => ['string'  => $faker->country,       'maps_to' => 'Country'],
    ]
  ]);
}

foreach ($rows as $r) { print $r; }
