<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Foglalas;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('szolgaltatasok', function (Blueprint $table) {
            $table->bigIncrements('szolgaltatasid');
            $table->string('szolgaltatasnev', 100);
            $table->text('leiras');
            $table->decimal('ar',10, 0);
            $table->unsignedBigInteger('user_felhasznaloid');
            $table->foreign('user_felhasznaloid')->references('felhasznaloid')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('szolgaltatasok');
    }
};
