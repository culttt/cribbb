<?php

class DatabaseSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Eloquent::unguard();

    $tables = array(
      'cribbbs',
      'users',
      'posts'
    );

    foreach ($tables as $table) {
      DB::table($table)->truncate();
    }

    $this->call('CribbbTableSeeder');
    $this->call('UserTableSeeder');
    $this->call('PostTableSeeder');
  }

}
