@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-2">
                            {{ __('Usuarios') }}
                        </div>
                        <div class="col-1 text-center" data-toggle="tooltip" data-placement="top" title="Agregar Usuario">
                            <a href="/registrarUsuario" class="text-success" >
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> name</th>
                                        <th> email</th>
                                        <th> password</th>
                                        <th> id_area</th>
                                        <th> id_empresa</th>
                                        <th> id_estado_usuario</th>
                                        <th> id_licencia</th>
                                        <th> id_rol</th>
                                        <th> pagina_web</th>
                                        <th> telefono</th>
                                        <th> id_turno</th>
                                        <th> contra_update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $user)
                                    @endforeach
                                    <tr>
                                        <td> {{  $user->name  }} </td>
                                        <td> {{  $user->email  }} </td>
                                        <td> {{  $user->password  }} </td>
                                        <td> {{  $user->id_area  }} </td>
                                        <td> {{  $user->id_empresa  }} </td>
                                        <td> {{  $user->id_estado_usuario  }} </td>
                                        <td> {{  $user->id_licencia  }} </td>
                                        <td> {{  $user->id_rol  }} </td>
                                        <td> {{  $user->pagina_web  }} </td>
                                        <td> {{  $user->telefono  }} </td>
                                        <td> {{  $user->id_turno  }} </td>
                                        <td>{{  $user->contra_update  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
