<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calleds', function (Blueprint $table) {
            $table->id();
            $table->string('protocol')->unique();;
            $table->longText('description');
            $table->longText('observation')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('status_calleds')->onDelete('cascade');     
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');            
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');            
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calleds');
    }
}
