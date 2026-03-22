<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTamagochisTableWithEvolution extends Migration
{
    public function up()
    {
        Schema::table('tamagochis', function (Blueprint $table) {
            // 'level' and 'experience' already exist from initial migration.
            // We add the missing fields for the new evolution system.
            $table->integer('evolution_points')->default(0)->after('experience');
            $table->timestamp('last_reset_at')->nullable()->after('evolution_points');
        });
    }

    public function down()
    {
        Schema::table('tamagochis', function (Blueprint $table) {
            $table->dropColumn(['evolution_points', 'last_reset_at']);
        });
    }
}
