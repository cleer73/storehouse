<?php

set_include_path(
  realpath('./') . PATH_SEPARATOR .
  get_include_path()
);

include 'vendor/fzaninotto/faker/src/autoload.php';
include 'src/Storehouse/Storehouse.php';
Storehouse\Storehouse::registerAutoloader();

$faker = new Faker\Generator();
$faker->addProvider(new Faker\Provider\en_US\Person($faker));
$faker->addProvider(new Faker\Provider\en_US\Address($faker));
$faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
$faker->addProvider(new Faker\Provider\en_US\Company($faker));
$faker->addProvider(new Faker\Provider\Lorem($faker));
$faker->addProvider(new Faker\Provider\Internet($faker));

$collection = Storehouse\Collection([
  'create_row': function ($row) {
    $fields = [
      'id' => [
        'integer' => $row['id'],
        'maps_to'  => 'Id',
        'default'  => null
      ],
      'first_name' => [
        'string'   => $row['firstName'],
        'maps_to'  => 'FirstName',
        'required' => true,
        'default'  => '_UNKNOWN_'
      ],
      'last_name' => [
        'string'  => $row['lastName'],
        'maps_to' => 'LastName'
      ],
      'address' => [
        'string'  => $row['streetAddress'],
        'maps_to' => 'Address'
      ],
      'city' => [
        'string'  => $row['city'],
        'maps_to' => 'City'
      ],
      'state' => [
        'string'  => $row['state'],
        'maps_to' => 'State'
      ],
      'postal_code' => [
        'string'  => $row['postcode'], 
        'maps_to' => 'PostalCode'
      ],
      'country' => [
        'string'  => $row['country'],
        'maps_to' => 'Country'
      ],
    ];

    return new Storehouse\Row(['fields' => $fields]);
  }
]);

foreach (range(1, 10) as $i) {
  $collection->add([
    'id'          => $i,
    'first_name'  => $faker->firstName,
    'last_name'   => $faker->lastName,
    'address'     => $faker->streetAddress,
    'city'        => $faker->city,
    'state'       => $faker->state, 
    'postal_code' => $faker->postcode, 
    'country'     => $faker->country,
  ]);
}

print $collection;
