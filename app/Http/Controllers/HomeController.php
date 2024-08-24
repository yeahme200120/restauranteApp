<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Categorias;
use App\Models\Empresa;
use App\Models\EstadoEmpresa;
use App\Models\EstadoUsuario;
use App\Models\EstatusProducto;
use App\Models\EstatusProvedor;
use App\Models\Insumo;
use App\Models\Licencia;
use App\Models\Producto;
use App\Models\Provedor;
use App\Models\RolUsuario;
use App\Models\TipoLicencia;
use App\Models\Turno;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuarios = User::join("estado_usuarios as estadoU", "estadoU.id","=","users.id_estado_usuario")
                    ->join("areas as a", "a.id","=","users.id_area")
                    ->join("empresas as e", "e.id","=","users.id_empresa")
                    ->join("rol_usuarios as r", "r.id","=","users.id_rol")
                    ->join("turnos as t", "t.id","=","users.id_turno")
                    ->where("users.id","!=",1)
                    ->get();
        return view('usuarios.usuarios', compact("usuarios"));
    }
    public function empresas()
    {
        $empresas = Empresa::all();
        return view('empresas.empresas', compact("empresas"));
    }
    public function setEmpresa()
    {
        $estatus = EstadoEmpresa::all();
        return view('empresas.setEmpresa',compact("estatus"));
    }
    public function registrarEmpresa(Request $request)
    {
        $request->validate([
            'ciudad' => 'required',
            'codigo_postal' => 'required',
            'domicilio_fiscal' => 'required',
            'giro' => 'required',
            'nombre_empresa' => 'required',
            'razon_social' => 'required',
            'RFC' => 'required|unique:empresas',
            'pais' => 'required',
            'estatus_empresa' => 'required',

        ],[
                'ciudad.required' => "El campo ciudad es un campo obligatorio",
                'codigo_postal.required' => "El campo codigo_postal es un campo obligatorio",
                'domicilio_fiscal.required' => "El campo domicilio_fiscal es un campo obligatorio",
                'giro.required' => "El campo giro es un campo obligatorio",
                'nombre_empresa.required' => "El campo nombre_empresa es un campo obligatorio",
                'razon_social.required' => "El campo razon_social es un campo obligatorio",
                'RFC.required' => "El campo RFC es un campo obligatorio",
                'pais.required' => "El campo pais es un campo obligatorio",
                'estatus_empresa.required' => "El campo estatus_empresa es un campo obligatorio", 
            ]
    );
        $registrada = new Empresa;
        $registrada->ciudad = $request->ciudad;
        $registrada->codigo_postal = $request->codigo_postal;
        $registrada->domicilio_fiscal = $request->domicilio_fiscal;
        $registrada->giro = $request->giro;
        $registrada->nombre_empresa = $request->nombre_empresa;
        $registrada->razon_social = $request->razon_social;
        $registrada->RFC = $request->RFC;
        $registrada->pais = $request->pais;
        $registrada->estatus_empresa = $request->estatus_empresa;
        if($registrada->save()){
            return redirect()->back()->with('success', 'Empresa registrada correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de registrar la empresa. Empresa no registrada 😌');
        }
    }
    public function editarEmpresa($id)
    {
        $estatus = EstadoEmpresa::all();
        $empresa = Empresa::findorfail($id);
        return view("empresas.editarEmpresa",compact("empresa","estatus"));
    }
    public function actualizarEmpresa(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'ciudad' => 'required',
            'codigo_postal' => 'required',
            'domicilio_fiscal' => 'required',
            'giro' => 'required',
            'nombre_empresa' => 'required',
            'razon_social' => 'required',
            'RFC' => 'required',
            'pais' => 'required',
            'estatus_empresa' => 'required',

        ],[
                'id.required' => "La empresa no fue localizada",
                'ciudad.required' => "El campo ciudad es un campo obligatorio",
                'codigo_postal.required' => "El campo codigo_postal es un campo obligatorio",
                'domicilio_fiscal.required' => "El campo domicilio_fiscal es un campo obligatorio",
                'giro.required' => "El campo giro es un campo obligatorio",
                'nombre_empresa.required' => "El campo nombre_empresa es un campo obligatorio",
                'razon_social.required' => "El campo razon_social es un campo obligatorio",
                'RFC.required' => "El campo RFC es un campo obligatorio",
                'pais.required' => "El campo pais es un campo obligatorio",
                'estatus_empresa.required' => "El campo estatus_empresa es un campo obligatorio", 
            ]
    );
        $registrada = Empresa::find($request->id);
        $registrada->ciudad = $request->ciudad;
        $registrada->codigo_postal = $request->codigo_postal;
        $registrada->domicilio_fiscal = $request->domicilio_fiscal;
        $registrada->giro = $request->giro;
        $registrada->nombre_empresa = $request->nombre_empresa;
        $registrada->razon_social = $request->razon_social;
        $registrada->RFC = $request->RFC;
        $registrada->pais = $request->pais;
        $registrada->estatus_empresa = $request->estatus_empresa;

        if($registrada->save()){
            return redirect("/empresas")->with('success', 'Empresa actualizada correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de actualizar la empresa');
        }
    }
    public function eliminarEmpresa($id)
    {
        $eliminada = Empresa::find($id);
        $eliminada->estatus_empresa = 0;

        if($eliminada->save()){
            return redirect("/empresas")->with('success', 'Empresa Eliminada correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de eliminar la empresa');
        }
    }
    public function registrarUsuario()
    {
        $empresas = Empresa::all();
        $areas = Area::all();
        $estados = EstadoUsuario::all();
        $licencias = TipoLicencia::all();
        $roles = RolUsuario::where("id","<>",1)->get();
        $turnos = Turno::all();

        return view("usuarios.registrarUsuario",compact("empresas","areas","estados","licencias","roles","turnos"));
    }
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_area' => ["required"],
            'id_empresa' => ["required"],
            'id_estado_usuario' => ["required"],
            'id_licencia' => ["required"],
            'id_rol' => ["required"],
            'pagina_web' => ["required"],
            'telefono' => ["required"],
            'id_turno' => ["required"],
        ],[
            "name.required" => "El campo name es un campo requerido",
            "email.required" => "El campo email es un campo requerido",
            "password.required" => "El campo password es un campo requerido",
            "id_area.required" => "El campo id_area es un campo requerido",
            "id_empresa.required" => "El campo id_empresa es un campo requerido",
            "id_estado_usuario.required" => "El campo id_estado_usuario es un campo requerido",
            "id_licencia.required" => "El campo id_licencia es un campo requerido",
            "id_rol.required" => "El campo id_rol es un campo requerido",
            "pagina_web.required" => "El campo pagina_web es un campo requerido",
            "telefono.required" => "El campo telefono es un campo requerido",
            "id_turno.required" => "El campo id_turno es un campo requerido",
        ]);

        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->id_area = $request->id_area;
        $usuario->id_empresa = $request->id_empresa;
        $usuario->id_estado_usuario = $request->id_estado_usuario;
        $usuario->id_licencia = $request->id_licencia;
        $usuario->id_rol = $request->id_rol;
        $usuario->pagina_web = $request->pagina_web;
        $usuario->telefono = $request->telefono;
        $usuario->id_turno = $request->id_turno;
        $usuario->contra_update = false;
        if($usuario->save()){
            return redirect("/")->with('success', 'Usuario registrado correctamente 😁');   
        }else{
            return redirect()->back()->with('error','Error al registrar el usuario 😣');
        }
    }
    //*********************     Metodos del provedor    *************************
    public function provedores(){
        $provedores = Provedor::select("provedors.*","e.nombre_empresa as empresa","c.categoria_producto as categoria","es.estatus_provedor as estatus")->join("empresas as e","e.id","=","provedors.id_empresa")->join("categorias as c","c.id","=","provedors.id_categoria")->join("estatus_provedors as es","es.id","=","provedors.id_Estatus_Provedor")->where("id_Estatus_provedor","<>",0)->get();
        return view("provedores.provedores", compact("provedores"));
    }
    public function registrarProvedor(){
        $empresas = Empresa::all();
        $categorias = Categorias::all();
        $estatusProv = EstatusProvedor::all();
        return view("provedores.registrarProvedor", compact("empresas","categorias", "estatusProv"));
    }
    public function createProvedor(Request $request){
        $request->validate([
            "nombre_provedor" => "required",
            "direccion" => "required",
            "correo" => "required",
            "id_categoria" => "required",
            "id_empresa" => "required",
            "nombre_empresa" => "required",
            "razon_social" => "required|unique:provedors",
            "telefono" => "required",
            "id_Estatus_provedor" => "required",


        ],[
                'nombre_provedor.required' => "El nombre del provedor es un campo obligatorio",
                'direccion.required' => "La direccion del provedor es un campo obligatorio",
                'correo.required' => "El Correo del provedor es un campo obligatorio",
                'id_categoria.required' => "La categoria del provedor es un campo obligatorio",
                'id_empresa.required' => "El campo nombre_empresa es un campo obligatorio",
                'id_empresa.required' => "El campo nombre_empresa es un campo obligatorio",
                'razon_social.unique' => "La razon social ya se encuentra registrada",
                'razon_social.required' => "La razon social es un campo obligatorio",
                'telefono.required' => "El telefono es un campo obligatorio",
                'id_Estatus_provedor.required' => "El campo del estatus es un campo obligatorio", 
            ]
        );  
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
            return redirect()->back()->with('success', 'Provedor registrado correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de registrar el provedor. Provedor no registrado 😌');
        }
    }
    public function editarProvedor($id){
        $provedor = Provedor::find($id);
        $empresas = Empresa::all();
        $categorias = Categorias::all();
        $estatusProv = EstatusProvedor::all();
        return view("provedores.editarProvedor",compact("provedor", "empresas","categorias", "estatusProv"));
    }
    public function actualizarProvedor(Request $request){
        $request->validate([
            "nombre_provedor" => "required",
            "direccion" => "required",
            "correo" => "required",
            "id_categoria" => "required",
            "id_empresa" => "required",
            "nombre_empresa" => "required",
            "telefono" => "required",
            "id_Estatus_provedor" => "required",


        ],[
                'nombre_provedor.required' => "El nombre del provedor es un campo obligatorio",
                'direccion.required' => "La direccion del provedor es un campo obligatorio",
                'correo.required' => "El Correo del provedor es un campo obligatorio",
                'id_categoria.required' => "La categoria del provedor es un campo obligatorio",
                'id_empresa.required' => "El campo nombre_empresa es un campo obligatorio",
                'id_empresa.required' => "El campo nombre_empresa es un campo obligatorio",
                'telefono.required' => "El telefono es un campo obligatorio",
                'id_Estatus_provedor.required' => "El campo del estatus es un campo obligatorio", 
            ]
        ); 
        $provedor = Provedor::find($request->id);
        $provedor->nombre_provedor = $request->nombre_provedor;
        $provedor->direccion = $request->direccion;
        $provedor->correo = $request->correo;
        $provedor->id_categoria = $request->id_categoria;
        $provedor->id_empresa = $request->id_empresa;
        $provedor->nombre_empresa = $request->nombre_empresa;
        $provedor->telefono = $request->telefono;
        $provedor->id_Estatus_provedor = $request->id_Estatus_provedor;
        if($provedor->save()){
            return redirect()->back()->with('success', 'Provedor actualizado correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de actualizar el provedor. Provedor no actualizado 😌');
        }
    }
    public function eliminarProvedor($id){
        $provedor = Provedor::find($id);
        $provedor->id_Estatus_provedor = 0;
        if($provedor->save()){
            return redirect()->back()->with('success', 'Provedor Eliminado correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de eliminar el provedor. El provedor no sufrio cambios 😌');
        }
    }
    //*********************     Fin metodos del provedor    **********************
    

     //*********************     Metodos del insumos    *************************
     public function insumos(){
        $insumos = Insumo::select("insumos.*","e.nombre_empresa as empresa","u.nombre_unidad as unidad","a.nombre_area as area","p.nombre_provedor as provedor")
        ->join("areas as a","a.id","=","insumos.id_area_insumo")
        ->join("unidads as u","u.id","=","insumos.id_unidad")
        ->join("empresas as e","e.id","=","insumos.id_empresa")
        ->join("provedors as p","p.id","=","insumos.id_provedor")
        ->get();
        return view("insumos.insumos", compact("insumos"));
    }
    public function registrarInsumos(){
        $areas = Area::all();
        $unidades = Unidad::all();
        $empresas = Empresa::all();
        $provedores = Provedor::all();
        return view("insumos.registrarInsumos", compact("empresas","areas", "unidades","provedores"));
    }
    public function createInsumos(Request $request){
        $request->validate([
            "descripcion" => "required",
            "id_area_insumo" => "required",
            "precio_unitario" => "required",
            "iva" => "required",
            "id_unidad" => "required",
            "cantidad" => "required",
            "id_empresa" => "required",
            "id_provedor" => "required",

        ],[
                'descripcion.required' => "La descripcion es un campo obligatorio",
                'id_area_insumo.required' => "El area es un campo obligatorio",
                'precio_unitario.required' => "El precio es un campo obligatorio",
                'iva.required' => "El iva es un campo obligatorio",
                'id_unidad.required' => "La unidad es un campo obligatorio",
                'cantidad.required' => "La cantidad es un campo obligatorio",
                'id_empresa.unique' => "La empresa es un campo obligatorio",
                'id_provedor.required' => "El provedor es un campo obligatorio",
            ]
        );  
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
            return redirect()->back()->with('success', 'Insumo registrado correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de registrar el insumo. Insumo no registrado 😌');
        }
    }
    public function editarInsumos($id){
        $insumo = Insumo::find($id);
        $areas = Area::all();
        $unidades = Unidad::all();
        $empresas = Empresa::all();
        $provedores = Provedor::all();
        return view("insumos.editarInsumos",compact("insumo", "areas","unidades", "empresas","provedores"));
    }
    public function actualizarInsumos(Request $request){
        $request->validate([
            "descripcion" => "required",
            "id_area_insumo" => "required",
            "precio_unitario" => "required",
            "iva" => "required",
            "id_unidad" => "required",
            "cantidad" => "required",
            "id_empresa" => "required",
            "id_provedor" => "required",

        ],[
                'descripcion.required' => "La descripcion es un campo obligatorio",
                'id_area_insumo.required' => "El area es un campo obligatorio",
                'precio_unitario.required' => "El precio es un campo obligatorio",
                'iva.required' => "El iva es un campo obligatorio",
                'id_unidad.required' => "La unidad es un campo obligatorio",
                'cantidad.required' => "La cantidad es un campo obligatorio",
                'id_empresa.unique' => "La empresa es un campo obligatorio",
                'id_provedor.required' => "El provedor es un campo obligatorio",
            ]
        );  
        $insumo = Insumo::find($request->id);
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
            return redirect()->back()->with('success', 'Insumo actualizado correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de actualizar el insumo. Insumo no registrado 😌');
        }
    }
    public function eliminarInsumo($id){
        $insumo = Insumo::find($id);
        $insumo->estatus = 0;
        if($insumo->save()){
            return redirect()->back()->with('success', 'Insumo Eliminado correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de eliminar el insumo. El insumo no sufrio cambios 😌');
        }
    }
    //*********************     Fin metodos del provedor    **********************

    //*********************     Metodos del Productos    *************************
    public function productos(){
        $productos = Producto::select("productos.*","p.nombre_provedor as provedor","e.nombre_empresa as empresa","es.estatus_producto as estatus","c.categoria_producto as categoria","u.nombre_unidad as unidad")
        ->join("empresas as e","e.id","=","productos.id_empresa")
        ->join("provedors as p","p.id","=","productos.id_provedor")
        ->join("categorias as c","c.id","=","productos.id_categoria")
        ->join("estatus_productos as es","es.id","=","productos.id_estatus_producto")
        ->join("unidads as u","u.id","=","productos.unidad")->get();
        return view("productos.productos", compact("productos"));
    }
    public function registrarProducto(){
        $empresas = Empresa::all();
        $categorias = Categorias::all();
        $estatus = EstatusProducto::all();
        $provedores = Provedor::all();
        $unidades = Unidad::all();
        return view("productos.registrarProducto", compact("empresas","categorias", "estatus", "provedores","unidades"));
    }
    public function createProducto(Request $request){
        $request->validate([
            "nombre_producto" => "required",
            "precio_compra" => "required",
            "precio_venta" => "required",
            "id_provedor" => "required",
            "stock" => "required",
            "iva" => "required",
            "id_empresa" => "required",
            "id_estatus_producto" => "required",
            "id_categoria" => "required",
            "unidad" => "required",
        ],[
                'nombre_producto.required' => "El nombre del producto es un campo obligatorio",
                'precio_compra.required' => "Precio de compra del producto es un campo obligatorio",
                'precio_venta.required' => "El precio de venta del producto es un campo obligatorio",
                'id_provedor.required' => "El provedor es un campo obligatorio",
                'stock.required' => "El campo stock es un campo obligatorio",
                'iva.required' => "El campo iva es un campo obligatorio. Este puede quedar en cero",
                'id_empresa.required' => "El campo de la empresa es un campo obligatorio",
                'id_estatus_producto.required' => "El estatus es un campo obligatorio",
                'id_categoria.required' => "La categoria es un campo obligatorio",
                'unidad.required' => "La unidad es un campo obligatorio", 
            ]
        );  
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
            return redirect()->back()->with('success', 'Producto registrado correctamente');   
        }else{   
            return redirect()->back()->with('error',`Error al tratar de registrar el producto. Producto no registrado 😌`);
        }
    }
    public function editarProducto($id){
        $producto = Producto::find($id);
        $provedores = Provedor::all();
        $empresas = Empresa::all();
        $categorias = Categorias::all();
        $estatus = EstatusProducto::all();
        $unidades = Unidad::all();
        return view("productos.editarProducto",compact("provedores","producto", "empresas","categorias", "estatus","unidades"));
    }
    public function actualizarProducto(Request $request){
        $request->validate([
            "nombre_producto" => "required",
            "precio_compra" => "required",
            "precio_venta" => "required",
            "id_provedor" => "required",
            "stock" => "required",
            "iva" => "required",
            "id_empresa" => "required",
            "id_estatus_producto" => "required",
            "id_categoria" => "required",
            "unidad" => "required",
        ],[
                'nombre_producto.required' => "El nombre del producto es un campo obligatorio",
                'precio_compra.required' => "Precio de compra del producto es un campo obligatorio",
                'precio_venta.required' => "El precio de venta del producto es un campo obligatorio",
                'id_provedor.required' => "El provedor es un campo obligatorio",
                'stock.required' => "El campo stock es un campo obligatorio",
                'iva.required' => "El campo iva es un campo obligatorio. Este puede quedar en cero",
                'id_empresa.required' => "El campo de la empresa es un campo obligatorio",
                'id_estatus_producto.required' => "El estatus es un campo obligatorio",
                'id_categoria.required' => "La categoria es un campo obligatorio",
                'unidad.required' => "La unidad es un campo obligatorio", 
            ]
        );  
        $producto = Producto::find($request->id);
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
            return redirect()->back()->with('success', 'Producto actualizado correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de actualizar el producto. Producto no actualizado 😌');
        }
    }
    public function eliminarProducto($id){
        $provedor = Producto::find($id);
        $provedor->id_Estatus_producto = 0;
        if($provedor->save()){
            return redirect()->back()->with('success', 'Producto Eliminado correctamente');   
        }else{
            return redirect()->back()->with('error','Error al tratar de eliminar el Producto. El Producto no sufrio cambios 😌');
        }
    }
    //*********************     Fin metodos del provedor    **********************
}
