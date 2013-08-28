<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class UserTest extends TestCase {

  /**
   * Test Username is required
   */
  public function testUsernameIsRequired()
  {
    // Create a new User
    $user = new User;
    $user->username = "";
    $user->email = "phil@ipbrown.com";
    $user->password = "password";
    $user->password_confirmation = "password";

    // User should not save
    $this->assertFalse($user->save());

    // Save the errors
    $errors = $user->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The username field is required.");
  }

  /**
   * Test Username should be 4 characters
   */
  public function testUsernameLength()
  {
    // Create first User
    $user1 = new User;
    $user1->username = "abc";
    $user1->email = "phil@ipbrown.com";
    $user1->password = "password";
    $user1->password_confirmation = "password";

    // User should not save
    $this->assertFalse($user1->save());

    // Save the errors
    $errors = $user1->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The username must be at least 4 characters.");
  }

  /**
   * Two users can't have the same username
   */
  public function testTwoUsersCantHaveTheSameUsername()
  {
    // Create first User
    $user1 = new User;
    $user1->username = "philipbrown";
    $user1->email = "phil@ipbrown.com";
    $user1->password = "password";
    $user1->password_confirmation = "password";
    // User should save
    $this->assertTrue($user1->save());

    // Create first User
    $user2 = new User;
    $user2->username = "philipbrown";
    $user2->email = "pb@yflag.com";
    $user2->password = "password";
    $user2->password_confirmation = "password";
    // User should save
    $this->assertFalse($user2->save());

    // Save the errors
    $errors = $user2->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The username has already been taken.");
  }

  /**
   * Test Email is required
   */
  public function testEmailIsRequired()
  {
    // Create a new User
    $user = new User;
    $user->username = "philipbrown";
    $user->password = "password";
    $user->password_confirmation = "password";

    // User should not save
    $this->assertFalse($user->save());

    // Save the errors
    $errors = $user->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The email field is required.");
  }

  /**
   * Test Email only accepts the correct format
   */
  public function testEmailFormat()
  {
    // Create a new User
    $user = new User;
    $user->username = "philipbrown";
    $user->email = "This is not an email address";
    $user->password = "password";
    $user->password_confirmation = "password";

    // User should not save
    $this->assertFalse($user->save());

    // Save the errors
    $errors = $user->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The email format is invalid.");
  }

  /**
   * Two users can't have the same username
   */
  public function testTwoUsersCantHaveTheSameEmail()
  {
    // Create first User
    $user1 = new User;
    $user1->username = "philipbrown";
    $user1->email = "phil@ipbrown.com";
    $user1->password = "password";
    $user1->password_confirmation = "password";
    // User should save
    $this->assertTrue($user1->save());

    // Create first User
    $user2 = new User;
    $user2->username = "philly";
    $user2->email = "phil@ipbrown.com";
    $user2->password = "password";
    $user2->password_confirmation = "password";
    // User should save
    $this->assertFalse($user2->save());

    // Save the errors
    $errors = $user2->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The email has already been taken.");
  }

  /**
   * Test Password is required
   */
  public function testPasswordIsRequired()
  {
    // Create a new User
    $user = new User;
    $user->username = "philipbrown";
    $user->email = "phil@ipbrown.com";
    $user->password_confirmation = "password";

    // User should not save
    $this->assertFalse($user->save());

    // Save the errors
    $errors = $user->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The password field is required.");
  }

  /**
   * Test Password and Confirmation match
   */
  public function testPasswordAndConfirmationMatch(){
    // Create a new User
    $user = new User;
    $user->username = "philipbrown";
    $user->email = "phil@ipbrown.com";
    $user->password = "password";
    $user->password_confirmation = "reallysecure";

    // User should not save
    $this->assertFalse($user->save());

    // Save the errors
    $errors = $user->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The password confirmation does not match.");
  }

  /**
   * Test Password Confirmatiom is required
   */
  public function testPasswordConfirmationIsRequired()
  {
    // Create a new User
    $user = new User;
    $user->username = "philipbrown";
    $user->email = "phil@ipbrown.com";
    $user->password = "password";

    // User should not save
    $this->assertFalse($user->save());

    // Save the errors
    $errors = $user->errors()->all();

    // There should be 2 errors
    $this->assertCount(2, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The password confirmation does not match.");

    // The error should be set
    $this->assertEquals($errors[1], "The password confirmation field is required.");
  }

  /**
   * Test a password can be updated correctly
   */
  public function testPasswordUpdatesCorrectly()
  {
    // Create a new User
    $user = new User;
    $user->username = "philipbrown";
    $user->email = "phil@ipbrown.com";
    $user->password = "password";
    $user->password_confirmation = "password";

    // User should save
    $this->assertTrue($user->save());

    // Find the user
    $philip = User::find(1);

    // Update password
    $philip->password = "newpassword";
    
    // User should save
    $this->assertTrue($philip->save());
  }

  /**
   * Test a user can follower other users
   */
  public function testUserCanFollowerUsers()
  {
    // Create users
    $philip = FactoryMuff::create('User');
    $jack = FactoryMuff::create('User');
    $ev = FactoryMuff::create('User');
    $biz = FactoryMuff::create('User');

    // First set
    $philip->follow()->save($jack);

    // First tests
    $this->assertCount(1, $philip->follow);
    $this->assertCount(0, $philip->followers);

    // Second set
    $jack->follow()->save($ev);
    $jack->follow()->save($biz);

    // Second tests
    $this->assertCount(2, $jack->follow);
    $this->assertCount(1, $jack->followers);

    // Third set
    $ev->follow()->save($jack);
    $ev->follow()->save($philip);
    $ev->follow()->save($biz);

    // Third tests
    $this->assertCount(3, $ev->follow);
    $this->assertCount(1, $ev->followers);

    // Fourth set
    $biz->follow()->save($jack);
    $biz->follow()->save($ev);

    // Fourth tests
    $this->assertCount(2, $biz->follow);
    $this->assertCount(2, $biz->followers);
  }

  public function testUserFeed()
  {
    // Create users
    $philip = FactoryMuff::create('User');
    $jack = FactoryMuff::create('User');
    $ev = FactoryMuff::create('User');
    $biz = FactoryMuff::create('User');

    // Create relationships
    $philip->follow()->save($jack);
    $philip->follow()->save($ev);
    $philip->follow()->save($biz);
    $biz->follow()->save($ev);
    $biz->follow()->save($jack);
    $jack->follow()->save($biz);
    $ev->follow()->save($biz);

    // Create posts
    $philip->posts()->save(FactoryMuff::create('Post'));
    $jack->posts()->save(FactoryMuff::create('Post'));
    $ev->posts()->save(FactoryMuff::create('Post'));
    $biz->posts()->save(FactoryMuff::create('Post'));

    // Set the current user
    $this->be($philip);

    // Assert count
    $posts = $philip->feed();
    $this->assertCount(4, $posts);

    // Set the current user
    $this->be($jack);

    // Assert count
    $posts = $jack->feed();
    $this->assertCount(2, $posts);

    // Set the current user
    $this->be($ev);

    // Assert count
    $posts = $ev->feed();
    $this->assertCount(2, $posts);

    // Set the current user
    $this->be($biz);

    // Assert count
    $posts = $biz->feed();
    $this->assertCount(3, $posts);
  }

}