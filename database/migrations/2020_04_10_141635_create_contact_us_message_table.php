<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us_message', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string("name", 300);
            $table->string("email", 300);
            $table->string("subject", 300);
            $table->string("message", 3000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us_message');
    }
}
