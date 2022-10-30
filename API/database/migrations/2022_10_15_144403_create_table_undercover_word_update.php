<?php

use App\Models\UndercoverWords;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('undercover', function (Blueprint $table) {
            $table->foreignIdFor(UndercoverWords::class)->references('id')->on('undercover_word');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('undercover', ['undercover_words_id']);
    }
};
