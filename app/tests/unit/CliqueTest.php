<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class CliqueTest extends TestCase {

  public function testNameIsRequired()
  {
    // Create a new Clique
    $clique = new Clique;

    // Post should not save
    $this->assertFalse($clique->save());

    // Save the errors
    $errors = $clique->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The name field is required.");
  }

}