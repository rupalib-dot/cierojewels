<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('childcategory_id')->after('subcategory_id');
            $table->string('mrp',20);
            $table->string('discount',20);
            $table->string('gross_weight',20)->after('product_size');
            $table->string('width',20)->after('product_size');
            $table->string('height',20)->after('width');
            $table->string('material')->after('gross_weight');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
