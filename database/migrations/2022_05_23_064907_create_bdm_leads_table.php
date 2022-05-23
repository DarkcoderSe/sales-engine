<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdmLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdm_leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->unsignedBigInteger('technology_id')->nullable();
            $table->unsignedBigInteger('job_source_id')->nullable();

            $table->string('company_name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('job_source_url')->nullable();
            $table->integer('status')->default(0)->comment('0=prospect;1=worm;2=hired');
            $table->timestamp('status_changed')->nullable();
            $table->text('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->text('job_description')->nullable();
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
        Schema::dropIfExists('bdm_leads');
    }
}
