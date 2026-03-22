<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDigitalTwinFieldsToTamagochis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tamagochis', function (Blueprint $table) {
            $table->text('context_vital')->nullable()->after('avatar');
            $table->string('ai_personality')->default('Colega sarcástico')->after('context_vital');
            $table->integer('foco')->default(50)->after('ai_personality');
            $table->integer('zen')->default(50)->after('foco');
            $table->string('current_thought', 255)->nullable()->after('zen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tamagochis', function (Blueprint $table) {
            $table->dropColumn(['context_vital', 'ai_personality', 'foco', 'zen', 'current_thought']);
        });
    }
}
