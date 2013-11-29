<?php

class UserTableSeeder extends Seeder {

  public function run()
  {
    $cribbbs = Cribbb::all();

    $user = User::create(array(
      'username' => 'philipbrown',
      'first_name' => 'Philip',
      'last_name' => 'Brown',
      'email' => 'phil@ipbrown.com',
      'password' => 'qwerty'
    ));

    foreach($cribbbs as $cribbb)
    {
      $user->cribbbs()->save($cribbb);
    }

    $faker = Faker\Factory::create();

    for ($i = 0; $i < 100; $i++)
    {
      $user = User::create(array(
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => $faker->word
      ));
    }
  }

}
