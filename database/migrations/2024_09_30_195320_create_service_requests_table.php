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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // services tablosuyla ilişki
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // services tablosuyla ilişki


            $table->enum('entity_type', ['individual', 'company']); // entity type: individual or company

            // Individual fields
            $table->string('name')->nullable();
            $table->string('surname')->nullable();

            // Company fields
            $table->string('company_name')->nullable();
            $table->string('salutation')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->string('company_size')->nullable();

            // Common fields
            $table->string('country');
            $table->string('city');
            $table->string('district');
            $table->string('profile_image')->nullable();
            $table->text('description')->nullable();
            $table->json('photos')->nullable(); // JSON olarak birden fazla fotoğrafı saklayabilirsin

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
        Schema::dropIfExists('service_requests');
    }
};
