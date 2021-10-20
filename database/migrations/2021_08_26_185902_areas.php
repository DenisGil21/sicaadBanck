<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Areas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('icon', 50);
            $table->string('area', 50);
            $table->integer('orden');
            $table->timestamps();
        });

        DB::table('areas')->insert(
            array(
                array(
                    'icon' => 'bi bi-house',
                    'area' => 'Inicio',
                    'orden'=>1
                ),
                array(
                    'icon' => 'bi bi-journal-bookmark',
                    'area' => 'Academico',
                    'orden'=>2
                ),
                array(
                    'icon' => 'bi bi-briefcase',
                    'area' => 'Administrativo',
                    'orden'=>3
                ),
                array(
                    'icon' => 'bi bi-cash-coin',
                    'area' => 'Financieros',
                    'orden'=>4
                ),
                array(
                    'icon' => 'bi bi-cpu',
                    'area' => 'Informatica',
                    'orden'=>5
                ),
                array(
                    'icon' => 'bi bi-check2-circle',
                    'area' => 'Recursos humanos',
                    'orden'=>6
                ),
                array(
                    'icon' => 'bi bi-gear',
                    'area' => 'Configuración',
                    'orden'=>99
                )
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('areas');
    }
}
