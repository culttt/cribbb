<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('username');
      $table->string('email');
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();
      $table->string('password')->nullable();
      $table->string('oauth_token')->nullable();
      $table->string('oauth_token_secret')->nullable();
      $table->integer('invitations')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('users');
  }

}
