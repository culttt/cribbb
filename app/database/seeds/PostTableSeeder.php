<?php

class PostTableSeeder extends Seeder {

  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i = 0; $i < 200; $i++)
    {
      $post = Post::create(array(
        'body' => $faker->text,
        'user_id' => 1
      ));

      $cribbb = Cribbb::find(1);

      $cribbb->posts()->save($post);

    }
  }

}
