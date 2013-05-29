<?php

class UserTest extends TestCase {

  /**
   * Test Username is required
   */
  public function testUsernameIsRequired()
  {
    // Create a new User
    $user = new User;
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
   * Test Username should be 4 - 16 characters
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
    $this->assertEquals($errors[0], "The username must be between 4 - 16 characters.");

    // Create second User
    $user2 = new User;
    $user2->username = "abcdefghijklmnopq";
    $user2->email = "phil@ipbrown.com";
    $user2->password = "password";
    $user2->password_confirmation = "password";

    // User should not save
    $this->assertFalse($user2->save());

    // Save the errors
    $errors = $user2->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The username must be between 4 - 16 characters.");
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
   * Test Password length
   */
  public function testPasswordLength()
  {
    // Create a new User
    $user = new User;
    $user->username = "philipbrown";
    $user->email = "phil@ipbrown.com";
    $user->password = "abc";
    $user->password_confirmation = "abc";

    // User should not save
    $this->assertFalse($user->save());

    // Save the errors
    $errors = $user->errors()->all();

    // There should be 2 errors
    $this->assertCount(2, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The password must be at least 8 characters.");

    // The error should be set
    $this->assertEquals($errors[1], "The password confirmation must be at least 8 characters.");
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

}