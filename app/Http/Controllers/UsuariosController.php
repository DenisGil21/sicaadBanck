<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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

    public function crear(Request $request)
    {

        $credentials = $request->only(['name','email', 'password']);
        $validator = Validator::make($credentials, [
            'name' => ['required'],
            'email' => ['required','unique:users'],
            'password' => ['required','min:5'],
        ],
        [
            'name.required' => 'El nombre de usuario es requerido',
            'email.required' =>'El correo es requerido',
            'email.unique' => 'El correo ya ha sido registrado',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe ser mayor a 4'
        ]
        );

        if($validator->fails())
        {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear usuario',
                'errors' => $validator->errors()
            ],401);
        }

        $campos = $request->all();
        $campos['password'] = bcrypt($request->password);
        $usuario = User::create($campos);
        
        // $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'ok' => true,
            'usuario' => $usuario,
            // 'token' => $token
        ], 201);

    }

}
