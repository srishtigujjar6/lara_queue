<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedAtToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }

    // add_created_at_to_user_mobilenos_table
    // Schema::table('user_mobilenos', function (Blueprint $table) {
    //     $table->softDeletes();
    // });
    // Schema::table('user_mobilenos', function (Blueprint $table) {
    //     $table->dropSoftDeletes();
    // });
}
