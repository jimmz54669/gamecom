<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userid');
            $table->string('ordersubtotal');
            $table->string('ordertotal');
            $table->string('orderdiscount')->nullable();
            $table->string('shippingfee');
            $table->string('ordertype');
            $table->string('ordertotalqty');
            $table->string('orderstatus');
            $table->string('orderaddress');
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
        Schema::dropIfExists('orders');
    }
}
