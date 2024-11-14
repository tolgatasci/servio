<?php

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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_step_id')->constrained('form_steps')->onDelete('cascade'); // Adımla ilişki
            $table->string('label'); // Alanın etiketi
            $table->string('type'); // Alanın tipi (text, number, select vb.)
            $table->string('rules')->nullable(); // Doğrulama kuralları
            $table->integer('publish')->default(0);
            $table->integer('order')->default(0);

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
        Schema::dropIfExists('form_fields');
    }
};
