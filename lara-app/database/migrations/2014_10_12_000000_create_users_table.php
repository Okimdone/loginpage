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

            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('uname')->unique();
            $table->string('password');

            // Foreign key
            $table->bigInteger('id_type_compte')->unsigned();
            $table->foreign('id_type_compte')->references('id')->on('type_comptes');

            $table->timestamps();
        });

        Schema::create('etudiants', function (Blueprint $table) {
            // Primary key Foreign key
            $table->bigIncrements('id');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');;

            $table->string('cne');
            $table->string('nom');
            $table->string('prenom');

            $table->timestamps();
        });

        Schema::create('enseignants', function (Blueprint $table) {
            // Primary key and foreign key
            $table->bigIncrements('id');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');;

            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();

            $table->timestamps();
        });
/*
        Schema::create('parcours', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            $table->string('semestre');
            $table->string('filiere');
        });
*/
        Schema::create('modules', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            $table->string('module');

            // Foreign key
            $table->bigInteger('id_prof')->unsigned();
            $table->foreign('id_prof')->references('id')->on('enseignants')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');

            $table->float('note')->nullable()->default(00.00);

            // Foreign key
            $table->bigInteger('id_module')->unsigned();
            $table->foreign('id_module')->references('id')->on('modules')->onDelete('cascade');
            // Foreign key
            $table->bigInteger('id_etud')->unsigned();
            $table->foreign('id_etud')->references('id')->on('etudiants')->onDelete('cascade');
            // Foreign key
            $table->bigInteger('id_prof')->unsigned();
            $table->foreign('id_prof')->references('id')->on('enseignants')->onDelete('cascade');

            $table->timestamps();
        });
/*
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


            // Primary key
            $table->primary(array('id_parcour', 'id_module', 'id_prof'));
        });
*/
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('type_comptes');
    }
}
