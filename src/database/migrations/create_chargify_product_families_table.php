<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargifyProductFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chargify_product_families', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_family_id');
            $table->char('name', 100);
            $table->text('description');
            $table->char('handle', 100);
            $table->char('accounting_code', 100)->nullable();
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
        Schema::dropIfExists('chargify_products');
    }
}
