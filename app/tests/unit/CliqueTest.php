<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class CliqueTest extends TestCase {

  /**
   * Test Name field is required
   */
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

  /**
   * Test creating a new user relationship
   */
  public function testCliqueUserRelationship()
  {
    // Create a new Clique
    $clique = FactoryMuff::create('Clique');

    // Create two Users
    $user1 = FactoryMuff::create('User');
    $user2 = FactoryMuff::create('User');

    // Save Users to the Clique
    $clique->users()->save($user1);
    $clique->users()->save($user2);

    // Count number of Users
    $this->assertCount(2, $clique->users);
  }

}