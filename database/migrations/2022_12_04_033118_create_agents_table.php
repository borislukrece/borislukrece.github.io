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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string("nom", 30);
            $table->string("prenom", 30);
            $table->string("tel", 10);
            $table->boolean("sexe")->nullable()->default(false);
            $table->date("date_naissance");
            $table->string("lieu_naissance", 125);
            $table->string("id_service", 255);
            $table->string("id_grade", 255);
            $table->string("adresse", 255);
            $table->string("email", 125)->unique();
            $table->string("username", 30)->unique();
            $table->string("mdp", 99);
            $table->boolean('admins')->nullable()->default(false);
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
        Schema::dropIfExists('agents');
    }
};
