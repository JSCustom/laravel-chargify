<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargifyCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chargify_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->char('first_name', 255);
            $table->char('last_name', 255);
            $table->char('email', 255);
            $table->char('organization', 255)->nullable();
            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->char('zip', 5)->nullable();
            $table->text('country')->nullable();
            $table->text('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chargify_customers');
    }
}
