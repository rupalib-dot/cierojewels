<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerBusinessProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_business_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('business_name',1000)->nullable();
            $table->string('gst',100)->nullable();
            $table->string('register_business_address',1000)->nullable();
            $table->enum('business_type',['Private Limited Company','Sole Proprietorship'])->nullable();
            $table->string('pan',100)->nullable();
            $table->string('acc_holder_name',1000)->nullable();
            $table->string('account_number',20)->nullable();
            $table->string('bank_name',100)->nullable();
            $table->string('city',50)->nullable();
            $table->string('branch',100)->nullable();
            $table->string('state',50)->nullable();
            $table->string('ifsc_code',20)->nullable();
            $table->string('display_name',100)->nullable();
            $table->text('business_description')->nullable();
            $table->string('pickup_city',100)->nullable();
            $table->string('pickup_address',1000)->nullable();
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
        Schema::dropIfExists('seller_business_profiles');
    }
}
