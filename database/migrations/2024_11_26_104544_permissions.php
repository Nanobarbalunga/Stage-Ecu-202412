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
        Schema::create('permissions', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('label')->unique();
            $table->string('pretty_label');
            $table->text('description');
            $table->timestamps();
        

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
