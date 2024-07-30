<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Empresa;
use App\Models\EstadoEmpresa;
use App\Models\EstadoUsuario;
use App\Models\Licencia;
use App\Models\RolUsuario;
use App\Models\TipoLicencia;
use App\Models\Turno;
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
        $usuarios = User::all();
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
}
