<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdmLeadDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdm_lead_developers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bdm_lead_id')->nullable();
            $table->unsignedBigInteger('developer_id')->nullable();
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
        Schema::dropIfExists('bdm_lead_developers');
    }
}
