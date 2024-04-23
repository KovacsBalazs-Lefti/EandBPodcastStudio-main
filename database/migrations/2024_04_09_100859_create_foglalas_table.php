<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('foglalas', function (Blueprint $table) {
            $table->bigIncrements('foglalasid');
            $table->unsignedBigInteger('user_felhasznaloid')->nullable();
            //$table->foreignIdFor(User::class)->constrained();
            $table->foreign('user_felhasznaloid')->references('felhasznaloid')->on('users');
            $table->string('szolgaltatasnev');
            $table->integer('letszam');
            $table->dateTime('foglalaskezdete');
            $table->integer('foglalashossza');
            $table->text('megjegyzes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foglalas');
    }
};
