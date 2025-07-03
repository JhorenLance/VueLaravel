<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('account_information')->onDelete('cascade');
            $table->string('company_name');
            $table->string('address_line');
            $table->string('town_city');
            $table->string('region_state');
            $table->string('country');
            $table->year('year_established');
            $table->string('website')->nullable();
            $table->string('brochure_path')->nullable();
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
        Schema::dropIfExists('company_information');
    }
};
