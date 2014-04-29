<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvitesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('invites', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('email');
      $table->string('invitation_code');
      $table->string('referral_code');
      $table->integer('referral_count')->default(0);
      $table->integer('referrer_id')->nullable();
      $table->timestamp('claimed_at')->nullable();
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
    Schema::drop('invites');
  }

}
