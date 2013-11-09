<?php

class UserTableSeeder extends Seeder {

  public function run()
  {

    $user = User::create(array(
      'username' => 'philipbrown',
      'first_name' => 'Philip',
      'last_name' => 'Brown',
      'email' => 'phil@ipbrown.com',
      'password' => 'qwerty'
    ));

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
