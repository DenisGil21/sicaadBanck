<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'ok'=>false,
                'msg'=>'Credenciales invalidas, favor de verificar ... '
            ], 401);
        }

        $user = User::where('email', $request['email'])->select('name','id','email')->firstOrFail();
        //$user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        $areas = DB::table('areas')->selectRaw('
            id,
            icon,
            area,
            IF(id=1, 1, 0) as activa
            ')
            ->get();
        $areaResp = array();
        foreach($areas as $a){
            $menus = DB::table('menus')
                ->where('id_area','=',$a->id)
                ->selectRaw('id, id_padre, url, icon, label')
                ->get();
            $menusResp = array();
            foreach($menus as $m){
                $menusResp[]=array(
                  'id'=>$m->id,
                  'id_padre'=>$m->id_padre,
                  'url'=>$m->url,
                  'icon'=>$m->icon,
                  'label'=>$m->label,

                );
            }
            $areaResp[] = array(
                'id'=>$a->id,
                'icon'=>$a->icon,
                'area'=>$a->area,
                'activa'=>$a->activa,
                'menus'=>$menusResp
            );
        }
        return response()->json([
            'ok'=>true,
            'name'=>$user->name,
            'uid'=>md5($user->id),
            'email'=>$user->email,
            'token'=>$token,
            'areas'=>$areaResp
        ]);
    }

    public function renew(Request $request){
        $userT = $request->user();
        //$userT->tokens()->delete();
        $request->user()->currentAccessToken()->delete();
        $user = User::where('id', $userT->id)->select('name','id','email')->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'ok'=>true,
            'name'=>$user->name,
            'uid'=>md5($user->id),
            'email'=>$user->email,
            'token'=>$token
        ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([ 'ok'=>true ]);
    }

    public function userMenu(Request $request){
        return $request->user();
    }

}
