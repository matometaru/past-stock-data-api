<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 4);
            $table->string('name');
            $table->char('color', 7)->nullable();;
            $table->string('url')->nullable();;
            $table->integer('market_id');
            $table->integer('category_id');
            $table->date('listing_date')->nullable();;
            $table->date('delisting_date')->nullable();;
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
        Schema::dropIfExists('stocks');
    }
}
