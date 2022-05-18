<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('client_name')->nullable();
            $table->string('job_title')->nullable();
            $table->integer('phase')->default(0)->comment('0=prospect;1=worm;2=hired;');
            $table->integer('status')->default(0)->comment('0=prospect;1=worm;2=hired;');
            $table->unsignedBigInteger('job_source_id')->nullable();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->unsignedBigInteger('technology_id')->nullable();
            $table->string('job_source_url')->nullable();
            $table->string('BD')->nullable();
            $table->date('assign_at')->nullable();
            $table->date('phase_effective')->nullable();
            $table->date('status_effective')->nullable();
            $table->string('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->text('job_description')->nullable();

            $table->unsignedBigInteger('added_by');

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
        Schema::dropIfExists('leads');
    }
}
