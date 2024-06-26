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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('felhasznaloid');
            $table->string('nev');
            $table->string('email')->unique();
            $table->string('jelszo');
            $table->string('role')->default('user');
            $table->string('telefonszam');
            $table->string('szemelyi_szam');
            $table->date('szuletesi_datum');
            $table->boolean('ceg')->default(false);
            $table->string('cegnev')->nullable();
            $table->string('ceg_tipus')->nullable();
            $table->string('ado_szam')->nullable();
            $table->string('bankszamlaszam')->nullable();
            $table->string('orszag');
            $table->string('iranyitoszam');
            $table->string('varos');
            $table->string('utca');
            $table->string('utca_jellege');
            $table->string('hazszam');
            $table->string('epulet')->nullable();
            $table->string('lepcsohaz')->nullable();
            $table->string('emelet')->nullable();
            $table->string('ajto')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
    $table->bigInteger('user_id')->unsigned()->nullable()->index(); // Megváltoztatott név
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->longText('payload');
    $table->integer('last_activity')->index();
    $table->foreign('user_id')->references('felhasznaloid')->on('users')->onDelete('set null'); // Kapcsolat felhasználó táblához
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
