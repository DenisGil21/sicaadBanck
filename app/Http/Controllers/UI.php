<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UI extends Controller
{
    //
    public function areas(Request $request){
        return response()->json([
            'ok'=>true,
            'areas'=>['Academico','Administrativo','Recursos humanos']
        ]);
    }
}
