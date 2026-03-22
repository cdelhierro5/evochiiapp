<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvatarToTamagochis extends Migration
{
    public function up()
    {
        Schema::table('tamagochis', function (Blueprint $table) {
            $table->string('avatar')->default('fish')->after('name');
        });
    }

    public function down()
    {
        Schema::table('tamagochis', function (Blueprint $table) {
            $table->dropColumn('avatar');
        });
    }
}
