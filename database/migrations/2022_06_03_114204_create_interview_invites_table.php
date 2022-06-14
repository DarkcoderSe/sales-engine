<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_invites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->unsignedBigInteger('bdm_lead_id')->nullable();

            $table->string('cc_emails')->nullable();
            $table->timestamp('event_start_at')->nullable();
            $table->string('event_timezone')->nullable();
            $table->integer('event_duration')->default(0);
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->string('interview_mode')->nullable();
            $table->string('interview_link')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_organization')->nullable();
            $table->string('client_website')->nullable();
            $table->string('client_job_title')->nullable();
            $table->string('position')->nullable();
            $table->string('salary_range')->nullable();
            $table->text('notes')->nullable();
            $table->integer('status')->default(0);

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
        Schema::dropIfExists('interview_invites');
    }
}
