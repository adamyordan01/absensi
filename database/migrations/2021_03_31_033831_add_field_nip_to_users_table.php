<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldNipToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip', 18)->nullable()->after('email')->unique();
            $table->unsignedBigInteger('rankandgroup_id')->nullable()->after('email');
            $table->text('address')->nullable()->after('email');
            $table->string('phone', 14)->nullable()->after('email');
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
            $table->dropColumn('nip');
            $table->dropColumn('rankandgroup_id');
            $table->dropColumn('address');
            $table->dropColumn('phone');
        });
    }
}
