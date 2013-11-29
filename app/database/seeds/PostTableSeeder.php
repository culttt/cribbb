<?php

class PostTableSeeder extends Seeder {

  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i = 0; $i < 100; $i++)
    {
      $post = Post::create::();
    }
  }

}
