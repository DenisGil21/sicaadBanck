<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UsuariosController extends Controller
{

    public function list(Request $request){
        return Datatables::of(
            DB::table('users')
                ->selectRaw('id, name, email, MD5(id) as mkey')
        )->make(true);
    }

    public function borrar(Request $request){
        return DB::table('users')
            ->whereRaw('MD5(id) LIKE \''.$request->input('key').'\'')
            ->delete();
    }

}
