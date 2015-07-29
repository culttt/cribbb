<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthClientsTable extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_clients', function (BluePrint $table) {
            $table->string('id')->primary();
            $table->string('secret');
            $table->timestamps();

            $table->unique(['id', 'secret']);
        });
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('oauth_clients');
    }
}
