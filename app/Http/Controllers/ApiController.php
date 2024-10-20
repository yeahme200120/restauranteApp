<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreaAlmacen;
use App\Models\Categorias;
use App\Models\CP;
use App\Models\Empresa;
use App\Models\EstadoUsuario;
use App\Models\EstatusProducto;
use App\Models\Insumo;
use App\Models\Licencia;
use App\Models\Producto;
use App\Models\Provedor;
use App\Models\RolUsuario;
use App\Models\CategoriasInsumos;
use App\Models\CategoriasProductos;
use App\Models\UnidadProducto;
use App\Models\Turno;
use App\Models\Unidad;
use App\Models\UnidadInsumo;
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
            $categoriasInsumos = CategoriasInsumos::where("empresa_id" , "=",$empresa)->get();
            $categoriasProductos = CategoriasProductos::where("empresa_id" , "=",$empresa)->get();
            //Obtenemos los insumos del usuario logeado
            $insumos = Insumo::where("id_empresa","=",$empresa)->where("estatus","<>",0)->get();
            //Obtenemos los productos del usuario logeado
            $productos = Producto::where("id_empresa","=",$empresa)->where("estatus","=",1)->get();
            //Obtenemos los provedores del usuario logeado
            $provedores = Provedor::where("id_empresa","=",$empresa)->where("id_estatus_provedor","<>",0)->where("id_estatus_provedor","<>",2)->get();
            //Obtenemos los unidades de medidas del usuario logeado
            $unidades = Unidad::where("id_empresa","=",$empresa)->where("estatus","=",1)->get();
            $unidadesInsumos = UnidadInsumo::where("id_empresa","=",$empresa)->where("estatus","=",1)->get();
            $estadosUsuarios = EstadoUsuario::all();
            $rolesUsuarios = RolUsuario::where("id",">",1)->get();
            $turnosEmpresa = Turno::where("empresa_id","=",$usuario->id_empresa)->get();
            $datos= [
                "Areas" => $areas,
                "Categorias" => $categorias,
                "Insumos" => $insumos,
                "Productos" => $productos,
                "Provedores" => $provedores,
                "Unidades" => $unidades,
                "EstadosUsuarios" => $estadosUsuarios,
                "RolesUsuarios" => $rolesUsuarios,
                "TurnosEmpresa" => $turnosEmpresa,
                "CategoriasInsumos" => $categoriasInsumos,
                "CategoriasProductos" => $categoriasProductos,
                "UnidadesInsumos" => $unidadesInsumos
            ];
            return $datos;
        }else{
            return "Sin datos que mostrar";
        }
    }
    public function setProducto(Request $request){
        if(!$request->nombre_producto || $request->nombre_producto == '' || $request->nombre_producto == null){ return ["msg"=>"No se recibio el campo Nombre"]; }
        if(!$request->precio_compra || $request->precio_compra == '' || $request->precio_compra == null){ return ["msg"=>"No se recibio el campo Precio de compra"]; }
        if(!$request->precio_venta || $request->precio_venta == '' || $request->precio_venta == null){ return ["msg"=>"No se recibio el campo Precio de venta"]; }
        if(!$request->id_provedor || $request->id_provedor == '' || $request->id_provedor == null){ return ["msg"=>"No se recibio el campo del Provedor"]; }
        if(!$request->cantidad || $request->cantidad == '' || $request->cantidad == null){ return ["msg"=>"No se recibio el campo Cantidad"]; }
        if(!$request->iva || $request->iva == '' || $request->iva == null){ return ["msg"=>"No se recibio el campo IVA"]; }
        if(!$request->id_empresa || $request->id_empresa == '' || $request->id_empresa == null){ return ["msg"=>"No se recibio el campo de la Empresa"]; }
        if(!$request->id_estatus_producto || $request->id_estatus_producto == '' || $request->id_estatus_producto == null){ return ["msg"=>"No se recibio el campo Estatus"]; }
        if(!$request->id_categoria || $request->id_categoria == '' || $request->id_categoria == null){ return ["msg"=>"No se recibio el campo de la Categoria"]; }
        if(!$request->unidad || $request->unidad == '' || $request->unidad == null){ return ["msg"=>"No se recibio el campo de la Unidad"]; }

        $producto = new Producto();
        $producto->nombre_producto = $request->nombre_producto;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->id_provedor = $request->id_provedor;
        $producto->stock = 0;
        $producto->cantidad = $request->cantidad;
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
        $insumo->nombre  = $request->nombre;
        $insumo->id_categoria_insumo  = $request->id_categoria_insumo;
        $insumo->clave  = $request->clave;
        $insumo->id_unidad  = $request->id_unidad;
        $insumo->stock  = $request->stock;
        $insumo->cantidad  = $request->cantidad;
        $insumo->id_empresa  = $request->id_empresa;
        $insumo->tipo  = $request->tipo;
        $insumo->estatus  = 1;        
        if($insumo->save()){
            return 1;   
        }else{
            return 0;
        }
    }

    public function setTurnos(Request $request){
        $user = (object) $request->usuario;
        $turno = (object) $request->turno;

        if(!$user){
            return ["msg"=> "No se recibio el Usuario"];
        }
        if(!$turno->turno || $turno->turno == '' || $turno->turno == null){ return ["msg"=> "No se recibio el campo Nombre del turno"]; }
        if(!$turno->hora_inicio || $turno->hora_inicio == '' || $turno->hora_inicio == null){ return ["msg"=> "No se recibio la hora inicio"]; }
        if(!$turno->hora_fin || $turno->hora_fin == '' || $turno->hora_fin == null){ return ["msg"=> "No se recibio la hora fin"]; }
        $hI = date($turno->hora_inicio);
        $hF = date($turno->hora_fin);
        $registro = new Turno();
        $registro->turno = $turno->turno;
        $registro->hora_inicio = $hI;
        $registro->hora_fin = $hF;
        $registro->empresa_id = $user->id_empresa;
        $registro->estatus = 1;

        if($registro->save()){
            return 1;   
        }else{
            return 0;
        }
    }
    
    public function setProvedor(Request $request){
        $user = (object) $request->usuario;
        if(!$user){
            return ["msg"=> "No se recibio el usuario"];
        }else{
            //Validaciones de campos vacios en los datos del provedor
            $prov = (object) $request->provedor;
            $empresa = Empresa::select("nombre_empresa")->where("id", "=",$user->id_empresa)->first();

            //Converimos a json para acceder a sus propiedades
            if(!$prov->nombre_provedor || $prov->nombre_provedor == null || $prov->nombre_provedor == '') { return ["msg"=>"El campo nombre_provedor no puede estar vacio"];}
            if(!$prov->direccion || $prov->direccion == null || $prov->direccion == '') { return ["msg"=>"El campo direccion no puede estar vacio"];}
            if(!$prov->correo || $prov->correo == null || $prov->correo == '') { return ["msg"=>"El campo correo no puede estar vacio"];}
            if(!$prov->id_categoria || $prov->id_categoria == null || $prov->id_categoria == '') { return ["msg"=>"El campo id_categoria no puede estar vacio"];}
            if(!$user->id_empresa || $user->id_empresa == null || $user->id_empresa == '') { return ["msg"=>"El usuario no cuenta con una empresa registrada"];}
            if(!$empresa->nombre_empresa || $empresa->nombre_empresa == null || $empresa->nombre_empresa == '') { return ["msg"=>"Valida la información de tu empresa"];}
            if(!$prov->razon_social || $prov->razon_social == null || $prov->razon_social == '') { return ["msg"=>"El campo razon_social no puede estar vacio"];}
            if(!$prov->telefono || $prov->telefono == null || $prov->telefono == '') { return ["msg"=>"El campo telefono no puede estar vacio"];}
             
            $provedor = new Provedor();
            $provedor->nombre_provedor = $prov->nombre_provedor;
            $provedor->direccion = $prov->direccion;
            $provedor->correo = $prov->correo;
            $provedor->id_categoria = $prov->id_categoria;
            $provedor->id_empresa = $user->id_empresa;
            $provedor->nombre_empresa = $empresa->nombre_empresa;
            $provedor->razon_social = $prov->razon_social;
            $provedor->telefono = $prov->telefono;
            $provedor->id_Estatus_provedor = 1;
            if($provedor->save()){
                return 1;
            }else{
                return 0;
            }
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
            $update->contra_update = ( ((int) $user->contra_update)   + 1 );
            if($update->save()){
                return 1;
            }else{
                return ["msg" => "Error al intentar cambiar la contraseña. Validar mas tarde"];
            }
        } 
    }
    public function getAreasApi(Request $request){
        $user = $request; 
        $usuario = User::find($user->id);
        $areas = [];
        if(!$usuario){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$usuario->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                $areas = Area::where("id_empresa","=",$usuario->id_empresa)->where("estatus_area","=",1)->get();
                return ["Areas" => $areas];
            }
        }
    }
    public function getCategoriasApi(Request $request){
        $user = $request; 
        $usuario = User::find($user->id);
        if(!$usuario){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$usuario->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                $categorias = Categorias::all();
                return ["Categorias" => $categorias];
            }
        }
    }
    public function getInsumosApi(Request $request){
        $user = $request; 
        $usuario = User::find($user->id);
        if(!$usuario){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$usuario->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                $insumos = Insumo::where("insumos.id_empresa","=",$usuario->id_empresa)
                ->where("estatus","=",1)
                ->get();
                return ["Insumos" => $insumos];
            }
        }
    }
    public function getProductosApi(Request $request){
        $user = $request; 
        $usuario = User::find($user->id);
        if(!$usuario){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$usuario->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                $productos = Producto::select("productos.*","empresas.nombre_Empresa","provedors.nombre_provedor","estatus_productos.estatus_producto","categorias.categoria_producto")
                ->join("empresas","empresas.id","=","productos.id_empresa")
                ->join("provedors","provedors.id","=","productos.id_provedor")
                ->join("estatus_productos","estatus_productos.id","=","productos.id_estatus_producto")
                ->join("categorias","categorias.id","=","productos.id_categoria")
                ->where("productos.id_empresa","=",$usuario->id_empresa)
                ->whereNotIn("id_estatus_producto",[0,2])
                ->get();
                return ["Productos" => $productos];
            }
        }
    }
    public function getProvedoresApi(Request $request){
        $user = $request; 
        $usuario = User::find($user->id);
        if(!$usuario){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$usuario->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                $provedores = Provedor::select("provedors.*","empresas.nombre_Empresa","categorias.categoria_producto","estatus_provedors.estatus_provedor")
                ->join("empresas","empresas.id","=","provedors.id_empresa")
                ->join("categorias","categorias.id","=","provedors.id_categoria")
                ->join("estatus_provedors","estatus_provedors.id","=","provedors.id_Estatus_provedor")
                ->where("provedors.id_empresa","=",$usuario->id_empresa)
                ->whereNotIn("provedors.id_estatus_provedor",[0,2])
                ->get();
                return ["Provedores" => $provedores];
            }
        }
    }
    public function getUnidadesApi(Request $request){
        $user = $request; 
        $usuario = User::find($user->id);
        if(!$usuario){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$usuario->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                $unidades = Unidad::where("id_empresa","=",$usuario->id_empresa)->where("estatus","=", 1)->get();
                return ["Unidades" => $unidades];
            }
        }
    }
    public function getAreaAlmacenApi(Request $request){
        $user = $request; 
        $usuario = User::find($user->id);
        $areas = AreaAlmacen::whereIn("id_empresa",[0,$usuario->id_empresa])->where("estatus_area","=",1)->get();
        if(!$usuario){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$usuario->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                return ["Areas_Almacen" => $areas ];
            }
        }
    }
    public function setAreaAlmacenApi(Request $request){
        $user = json_decode($request->usuario); 
        $usuario = User::find($user->id);
        $contador = 0;
        $areas = AreaAlmacen::whereIn("id_empresa",[0,$usuario->id_empresa])->get();
        $contador = $areas->count();
        $limite = 10;
        //Segundo parametro
        if(!$request->nombre_area){
            return ["msg" => "El nombre de la nueva Área es requerido. Valida tu información...."];
        } else {
            $nombre =  $request->nombre_area; 
        }

        if(!$usuario){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$usuario->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                //Licencia completa
                if(!$usuario->id_licencia == 1){
                    $area = new AreaAlmacen();
                    $area->nombre_area = $nombre;
                    $area->id_empresa = $usuario->id_empresa;
                    $area->estatus_area = 1;
                    if($area->save()){
                        return ["msg" => "Se registro correctamente el area $nombre"];
                    } else {
                        return ["msg" => "Error al tratar de registrar el área nueva"];
                    };             
                } else {
                //licencia basica
                    if($contador <= $limite){
                        $area = new AreaAlmacen();
                        $area->nombre_area = $nombre;
                        $area->id_empresa = $usuario->id_empresa;
                        $area->estatus_area = 1;
                        if($area->save()){
                            return ["msg" => "Se registro correctamente el área $nombre"];
                        } else {
                            return ["msg" => "Error al tratar de registrar el área nueva"];
                        };
                    } else {
                        return ["msg" => "Esta licencia solo permite registrar maximo $limite areas"];
                    }
                }
            }
        }
    }
    public function getEstatusProducto(Request $request){
        $user = $request; 
        $usuario = User::find($user->id);
        $estatus = [];
        if(!$usuario){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$usuario->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                $estatus = EstatusProducto::all();
                return ["EstatusProducto" => $estatus];
            }
        }
    }
    public function getEmpresaName(Request $request){
        $user = $request; 
        $usuario = User::find($user->id);
        $empresa = [];
        if(!$usuario){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$usuario->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                $empresa = Empresa::select("nombre_empresa")->where("id", "=", $usuario->id_empresa)->first();
                return ["Empresa" => $empresa];
            }
        }
    }
    public function getRolUsuarios(){
        $roles = RolUsuario::where("id",">",2)->get();
        return $roles;
    }
    public function getTurnoUsuario(Request $request){
        $usuario = $request;
        $turnos = Turno::where("empresa_id","=",$usuario->id_empresa)->where("estatus","=",1)->get();
        return $turnos;
    }
    public function getEstatusUsuarios(Request $request){
        $usuario = $request;
        $estatus = EstadoUsuario::select("id","estado_usuario")->where("id_empresa","=",$usuario->id_empresa)->get();
        return $estatus;
    }
    public function registraUsuario(Request $request){
        $usuario = (object)$request->usuario;
        $datos = (object)$request->datos;
        /* $respuesta = [ "Usuario" => $usuario, "Datos" => $datos ];
        return $respuesta;
         */if(!$usuario){return ["msg"=> "No se recibieron los datos del usuario Administrador"];}
        if(!$datos){return ["msg"=> "No se recibieron los datos del usuario a registrar"];}
        if($datos->name == null || $datos->name == '' || $datos->name == null ){ return ["msg" => "el campo name no puede estar vacio"];};
        if($datos->correo == null || $datos->correo == '' || $datos->correo == null ){ return ["msg" => "el campo email no puede estar vacio"];};
        if($datos->password == null || $datos->password == '' || $datos->password == null ){ return ["msg" => "el campo password no puede estar vacio"];};
        if($datos->id_area == null || $datos->id_area == '' || $datos->id_area == null ){ return ["msg" => "el campo id_area no puede estar vacio"];};
        if($datos->id_estado_usuario == null || $datos->id_estado_usuario == '' || $datos->id_estado_usuario == null ){ return ["msg" => "el campo id_estado_usuario no puede estar vacio"];};
        if($usuario->id_licencia == null || $usuario->id_licencia == '' || $usuario->id_licencia == null ){ return ["msg" => "Valida tu licencia"];};
        if($datos->id_rol == null || $datos->id_rol == '' || $datos->id_rol == null ){ return ["msg" => "el campo id_rol no puede estar vacio"];};
        if($datos->telefono == null || $datos->telefono == '' || $datos->telefono == null ){ return ["msg" => "el campo telefono no puede estar vacio"];};
        if($datos->id_turno == null || $datos->id_turno == '' || $datos->id_turno == null ){ return ["msg" => "el campo id_turno no puede estar vacio"];};
        

        $registro = new User();
        $registro->name = $datos->name;
        $registro->email = $datos->correo;
        $registro->password = Hash::make($datos->password);
        $registro->id_area = $datos->id_area;
        $registro->id_empresa = $usuario->id_empresa;
        $registro->id_estado_usuario = $datos->id_estado_usuario;
        $registro->id_licencia = $usuario->id_licencia;
        $registro->id_rol = $datos->id_rol;
        $registro->pagina_web = '';
        $registro->telefono = $datos->telefono;
        $registro->id_turno = $datos->id_turno;
        $registro->contra_update = 0;
        if($registro->save()){
            return 1;
        }else{
            return 0;
        }

    }
    public function getUsuariosEmpresa(Request $request){
        $usuario = $request;
        $users = User::where("id_empresa","=",$usuario->id_empresa)->where("id_rol",">",1)->get();
        return $users;
    }
    public function updateUsuarios(Request $request){
        if(!$request->usuario){
            return ["msg"=> "No se recibio el usuario logeado"];
        }else{
            if(!$request->datos){return ["msg"=> "No se recibieron los datos del usuario"];}
            $datos = (object)$request->datos;
            $user = (object) $request->usuario;
            
            if($datos->name == null || $datos->name == '' || $datos->name == null ){ return ["msg" => "El nombre del usuario no puede estar vacio"];};
            if($datos->id_area == null || $datos->id_area == '' || $datos->id_area == null ){ return ["msg" => "El campo área no puede estar vacio"];};
            if($datos->id_estado_usuario == null || $datos->id_estado_usuario == '' || $datos->id_estado_usuario == null ){ return ["msg" => "El campo del estado del usuario no puede estar vacio"];};
            if($datos->id_rol == null || $datos->id_rol == '' || $datos->id_rol == null ){ return ["msg" => "El rol del usuario no puede estar vacio"];};
            if($datos->telefono == null || $datos->telefono == '' || $datos->telefono == null ){ return ["msg" => "El teléfono del usuario no puede estar vacio"];};
            if($datos->id_turno == null || $datos->id_turno == '' || $datos->id_turno == null ){ return ["msg" => "El campo del turno del usuario no puede estar vacio"];};

            $update = User::find($user->id);
            $update->name = $datos->name;
            $update->id_area = $datos->id_area;
            $update->id_estado_usuario = $datos->id_estado_usuario;
            $update->id_rol = $datos->id_rol;
            $update->telefono = $datos->telefono;
            $update->id_turno = $datos->id_turno;

            if($update->save()){
                return 1;
            }else{
                return ["msg"=> "Surgio un error al registrar. Vuelve a intentarlo"];
            }
        }        
    }
    public function getUsuarioLogueado(Request $request){
        $usuario = (object)$request;
        $users = User::find($usuario->id);
        return $users;
    }

    //Nuevas  Apis
    public function setCategoriaInsumo(Request $request){
        $categoria = $request->categoria;
        $user = (object)$request->usuario;
        //Segundo parametro
        if(!$categoria){
            return ["msg" => "El nombre de la nueva categoria es requerido. Valida tu información...."];
        } else {
            $nombre =  $request->categoria; 
        }

        if(!$user){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$user->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                $categoria = new CategoriasInsumos();
                $categoria->categoria = $nombre;
                $categoria->empresa_id = $user->id_empresa;
                if($categoria->save()){
                    return ["msg" => "Se registro correctamente el area $nombre"];
                } else {
                    return ["msg" => "Error al tratar de registrar el área nueva"];
                };             
            }
        }
    }
    public function setUnidadInsumo(Request $request){
        $user = (object)($request->usuario); 
        //Segundo parametro
        if(!$request->categoria){
            return ["msg" => "El nombre de la nueva categoria es requerido. Valida tu información...."];
        } else {
            $nombre =  $request->categoria; 
        }

        if(!$user){
            return ["msg" => "No se recibio el usuario"];
        }else{
            if(!$user->id_empresa){
                return ["msg" => "No se encontraro datos relacionados con el usuario"];
            }else{
                $unidad = new UnidadInsumo();
                $unidad->unidad = $nombre;
                $unidad->id_empresa = $user->id_empresa;
                $unidad->estatus = 1;
                if($unidad->save()){
                    return ["msg" => "Se registro correctamente la unidad $nombre"];
                } else {
                    return ["msg" => "Error al tratar de registrar la unidad. Intenta nuevamente......"];
                };             
            }
        }
    }
    
}
