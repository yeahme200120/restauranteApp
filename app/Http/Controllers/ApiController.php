<?php

namespace App\Http\Controllers;

use App\Models\CP;
use App\Models\Empresa;
use App\Models\Licencia;
use App\Models\Turno;
use App\Models\User;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    public function getCP($cp)
    {
        $resp = 0; 
        $codigo=CP::where("codigo","=",$cp)->first();   
        if($codigo){
            $resp =json_encode($codigo);
        }
        return $resp;
    }
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        $remember = $request->filled('remember');
        $user = User::where('email','=',$request->email)->first();
        if (isset($user->id)){
            if (Hash::check($request->password, $user->password)) {
                //Agregaremos la validacion de la licencia, estatus, turno 
                $empresa = Empresa::find($user->id_empresa);
                $licencia = Licencia::find($empresa->id);
                $turno = Turno::find($user->id_turno);
                $fecha2 = new DateTime();
                $fecha = date_format($fecha2, 'H:i:s');
                $fechaLicencia = date(now());

                //Validamos si el usuario esta activo
                if($user->id_estado_usuario <> 1){
                    return ["msg" => "El usuario no se encuentra activo...."];
                }else{
                    //Validamos si esta dentro de su turno
                    if($turno->hora_inicio >= $fecha && $turno->hora_fin <= $fecha ){
                        //Validamos que la licencia este vigente
                        if($licencia->fecha_inicio <= $fechaLicencia && $licencia->fecha_fin >= $fechaLicencia){
                            try {
                                Auth::login($user, $remember);
                                return auth()->user();
                            } catch (\Throwable $th) {
                                return $th;
                            }
                        }else{
                            return ["msg" => "Licencia inactiva"];
                        }
                    }else{  
                        //si no esta dentro de su horario
                        return ["msg" => "Estaas fuera de tu horario"];
                    }
                }                
            }else{
                return ["msg" => "Credenciales incorrectas"];
            }
        }else{
            return ["msg" => "Usuario no registrado"];
        }

    
    }

}
