<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); //

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });

        // Insert some stuff
        DB::table('roles')->insert([['name' => 'admin'], ['name' => 'seller']]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
