<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldssInBdmLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bdm_leads', function (Blueprint $table) {
            $table->integer('phase')->default(0);
            $table->timestamp('phase_changed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bdm_leads', function (Blueprint $table) {
            $table->dropColumn('phase');
            $table->dropColumn('phase_changed_at');
        });
    }
}
