<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Categorias;
use App\Models\CP;
use App\Models\Empresa;
use App\Models\Insumo;
use App\Models\Licencia;
use App\Models\Producto;
use App\Models\Provedor;
use App\Models\Turno;
use App\Models\Unidad;
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
                    if($fecha >= $turno->hora_inicio && $fecha <= $turno->hora_fin){
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
                        return ["msg" => "Estas fuera de tu horario"];
                    }
                }                
            }else{
                return ["msg" => "Credenciales incorrectas"];
            }
        }else{
            return ["msg" => "Usuario no registrado"];
        }

    
    }
    public function getCatalogos(Request $request){
        $usuario = User::find($request->usuario);
        $datos = [];
        if($usuario){
            $empresa = $usuario->id_empresa;
            //Obtenemos las areas de la empresa del usuario logeado
            $areas = Area::where("id_empresa","=",$empresa)->where("estatus_area","=",1)->get();
            //Obtenemos las categorias del usuario logeado
            $categorias = Categorias::all();
            //Obtenemos los insumos del usuario logeado
            $insumos = Insumo::where("id_empresa","=",$empresa)->where("estatus","<>",0)->get();
            //Obtenemos los productos del usuario logeado
            $productos = Producto::where("id_empresa","=",$empresa)->where("id_estatus_producto","<>",0)->where("id_estatus_producto","<>",2)->get();
            //Obtenemos los provedores del usuario logeado
            $provedores = Provedor::where("id_empresa","=",$empresa)->where("id_estatus_provedor","<>",0)->where("id_estatus_provedor","<>",2)->get();
            //Obtenemos los unidades de medidas del usuario logeado
            $unidades = Unidad::where("id_empresa","=",$empresa)->where("estatus","=",1)->get();
            $datos= [
                "Areas" => $areas,
                "Categorias" => $categorias,
                "Insumos" => $insumos,
                "Productos" => $productos,
                "Provedores" => $provedores,
                "Unidades" => $unidades
            ];
            return $datos;
        }else{
            return "Sin datos que mostrar";
        }
    }
    public function setProducto(Request $request){ 
        $producto = new Producto();
        $producto->nombre_producto = $request->nombre_producto;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->id_provedor = $request->id_provedor;
        $producto->stock = $request->stock;
        $producto->iva = $request->iva;
        $producto->id_empresa = $request->id_empresa;
        $producto->id_estatus_producto = $request->id_estatus_producto;
        $producto->id_categoria = $request->id_categoria;
        $producto->unidad = $request->unidad;
        if($producto->save()){
            return 1; 
        }else{   
            return 0;
        }
    }
    public function setInsumo(Request $request){
        $insumo = new Insumo();
        $insumo->descripcion = $request->descripcion;
        $insumo->id_area_insumo = $request->id_area_insumo;
        $insumo->precio_unitario = $request->precio_unitario;
        $insumo->iva = $request->iva;
        $insumo->id_unidad = $request->id_unidad;
        $insumo->cantidad = $request->cantidad;
        $insumo->id_empresa = $request->id_empresa;
        $insumo->id_provedor = $request->id_provedor;
        $insumo->estatus = 1;
        if($insumo->save()){
            return 1;   
        }else{
            return 0;
        }
    }
    
    public function setProvedor(Request $request){
        $provedor = new Provedor();
        $provedor->nombre_provedor = $request->nombre_provedor;
        $provedor->direccion = $request->direccion;
        $provedor->correo = $request->correo;
        $provedor->id_categoria = $request->id_categoria;
        $provedor->id_empresa = $request->id_empresa;
        $provedor->nombre_empresa = $request->nombre_empresa;
        $provedor->razon_social = $request->razon_social;
        $provedor->telefono = $request->telefono;
        $provedor->id_Estatus_provedor = $request->id_Estatus_provedor;
        if($provedor->save()){
            return 1;
        }else{
            return 0;
        }
    }
    public function changePasswordApi(Request $request)
    {
        $user = json_decode($request->usuario);
        if(!$user->id) { return ["msg" => "No se recibieron los datos del usuario"];}
        if(!$request->new_password) { return ["msg" => "No se recibio la nueva Contraseña"];}

        if($user->id_estado_usuario <> 1){
            return ["msg" => "El usuario no se encuentra activo...."];
        }else{
            $update = User::find($user->id);
            $update->password = Hash::make($request->new_password);
            $update->contra_update = ($user->contra_update + 1);
            if($update->save()){
                return 1;
            }else{
                return ["msg" => "Error al intentar cambiar la contraseña. Validar mas tarde"];
            }
        } 
    }

}
