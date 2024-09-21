<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fighters', function (Blueprint $table) {
            $table->id();
            $table->string('m_card');
            $table->string('p_visa');
            $table->string('sex');
            $table->string('fname');
            $table->string('email');
            $table->string('phone');
            $table->string('fightname');
            $table->string('nationalty');
            $table->date('birthday');
            $table->string('emergency');
            $table->date('sta_date');
            $table->date('exp_date');
            $table->string('type_training');
            $table->text('comment');
            $table->text('accom');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fighters');
    }
};
