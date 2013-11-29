<?php

class CribbbTableSeeder extends Seeder {

  public function run()
  {
    $cribbbs = array(
      'Cribbb',
      'Startups',
      'Business',
      'Laravel',
      'PHP'
    );

    foreach($cribbbs as $c)
    {
      $cribbb = Cribbb::create(array(
        'name' => $c,
        'slug' => strtolower($c)
      ));
    }
  }

}
