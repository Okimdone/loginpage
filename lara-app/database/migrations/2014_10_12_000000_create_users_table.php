<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_comptes', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('type');
        });

        Schema::create('comptes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nom_utilisateur');
            $table->string('mdp');

            // Foreign key
            $table->bigInteger('id_type_compte')->unsigned();
            $table->foreign('id_type_compte')->references('id')->on('type_comptes');
        });

        Schema::create('etudiants', function (Blueprint $table) {
            // Primary key Foreign key
            $table->bigIncrements('id');
            $table->foreign('id')->references('id')->on('comptes')->onDelete('cascade');;

            $table->string('cne');
            $table->string('nom');
            $table->string('prenom');
        });

        Schema::create('professeurs', function (Blueprint $table) {
            // Primary key and foreign key
            $table->bigIncrements('id');
            $table->foreign('id')->references('id')->on('comptes')->onDelete('cascade');;

            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
        });

        Schema::create('parcours', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            $table->string('semestre');
            $table->string('filiere');
        });

        Schema::create('modules', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            $table->string('module');
        });

        Schema::create('evalues', function (Blueprint $table) {
            // Foreign key
            $table->bigInteger('id_parcour')->unsigned();
            $table->foreign('id_parcour')->references('id')->on('parcours')->onDelete('cascade');

            // Foreign key
            $table->bigInteger('id_module')->unsigned();
            $table->foreign('id_module')->references('id')->on('modules')->onDelete('cascade');

            // Foreign key
            $table->bigInteger('id_etudiant')->unsigned();
            $table->foreign('id_etudiant')->references('id')->on('etudiants')->onDelete('cascade');

            $table->float('note')->nullable();

            // Primary key
            $table->primary(array('id_parcour', 'id_module', 'id_etudiant'));
        });

        Schema::create('ensegnes', function (Blueprint $table) {
            // Foreign key
            $table->bigInteger('id_parcour')->unsigned();
            $table->foreign('id_parcour')->references('id')->on('parcours')->onDelete('cascade');

            // Foreign key
            $table->bigInteger('id_module')->unsigned();
            $table->foreign('id_module')->references('id')->on('modules')->onDelete('cascade');

            // Foreign key
            $table->bigInteger('id_prof')->unsigned();
            $table->foreign('id_prof')->references('id')->on('professeurs')->onDelete('cascade');

            // Primary key
            $table->primary(array('id_parcour', 'id_module', 'id_prof'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ensegnes');
        Schema::dropIfExists('evalues');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('parcours');
        Schema::dropIfExists('professeurs');
        Schema::dropIfExists('etudiants');
        Schema::dropIfExists('comptes');
        Schema::dropIfExists('type_comptes');
    }
}
