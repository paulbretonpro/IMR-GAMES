<?php

use App\Models\Members;
use App\Models\Undercover;
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
        Schema::create('undercover_members', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->foreignId('undercover_id')->references('id')->on('undercover')->onDelete('cascade');
            $table->foreignId('members_id')->references('id')->on('members')->onDelete('cascade');
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
        Schema::dropIfExists('undercover_members');
    }
};
