<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargifyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chargify_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->char('name', 100);
            $table->char('handle', 100);
            $table->text('description');
            $table->text('accounting_code')->nullable();
            $table->boolean('require_credit_card')->default(true);
            $table->integer('price_in_cents');
            $table->integer('interval')->default(1);
            $table->char('interval_unit', 50)->default('month');
            $table->boolean('auto_create_signup_page')->default(true);
            $table->text('tax_code');
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
