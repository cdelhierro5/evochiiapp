<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHabitsTableWithStats extends Migration
{
    public function up()
    {
        Schema::table('habits', function (Blueprint $table) {
            $table->integer('energy_impact')->default(0)->after('reward_energy');
            $table->integer('focus_impact')->default(0)->after('energy_impact');
            $table->integer('zen_impact')->default(0)->after('focus_impact');
            $table->integer('xp_reward')->default(10)->after('zen_impact');
        });
    }

    public function down()
    {
        Schema::table('habits', function (Blueprint $table) {
            $table->dropColumn(['energy_impact', 'focus_impact', 'zen_impact', 'xp_reward']);
        });
    }
}
