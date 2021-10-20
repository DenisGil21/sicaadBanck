<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Menus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('id_area');
            $table->integer('id_padre');
            $table->string('url', 100);
            $table->string('icon', 50);
            $table->string('label', 50);
            $table->timestamps();
        });

        DB::table('menus')->insert(
            array(
                array(
                    'id_area' => 1,
                    'id_padre' => 0,
                    'url' => '/app/dashboard',
                    'icon' => '',
                    'label' => 'Dashboard',
                ),
                array(
                    'id_area' => 1,
                    'id_padre' => 0,
                    'url' => '/app/pagina2',
                    'icon' => '',
                    'label' => 'Pagina 2',
                ),
                array(
                    'id_area' => 2,
                    'id_padre' => 0,
                    'url' => '#',
                    'icon' => '',
                    'label' => 'Catalogos',
                ),
                array(
                    'id_area' => 2,
                    'id_padre' => 0,
                    'url' => '#',
                    'icon' => '',
                    'label' => 'Alumnos',
                ),
                array(
                    'id_area' => 2,
                    'id_padre' => 0,
                    'url' => '#',
                    'icon' => '',
                    'label' => 'Maestros',
                ),
                array(
                    'id_area' => 2,
                    'id_padre' => 0,
                    'url' => '#',
                    'icon' => '',
                    'label' => 'Inscripciones',
                ),
                array(
                    'id_area' => 2,
                    'id_padre' => 0,
                    'url' => '#',
                    'icon' => '',
                    'label' => 'Horarios',
                ),
                array(
                    'id_area' => 2,
                    'id_padre' => 0,
                    'url' => '#',
                    'icon' => '',
                    'label' => 'Calificaciones',
                ),
                array(
                    'id_area' => 2,
                    'id_padre' => 0,
                    'url' => '#',
                    'icon' => '',
                    'label' => 'Reportes',
                ),
                array(
                    'id_area' => 7,
                    'id_padre' => 0,
                    'url' => '/app/config/usuarios',
                    'icon' => '',
                    'label' => 'Usuarios',
                ),
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
        Schema::drop('menus');
    }
}
