@extends('layouts.app')

@section('content')
    <div class="container">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-2">
                            <b>{{ __('Provedores') }}</b>
                        </div>
                        <div class="col-1 text-center" data-toggle="tooltip" data-placement="top" title="Agregar Provedor">
                            <a href="/registrarProvedor" class="text-success" >
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
                                        <th> Nombre</th>
                                        <th> Direccion</th>
                                        <th> Correo</th>
                                        <th> Categoria</th>
                                        <th> Empresa</th>
                                        <th> nombre de la Empresa</th>
                                        <th> Razon Social</th>
                                        <th> Telefono</th>
                                        <th> Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset( $provedores ))
                                    @foreach ($provedores as $provedor)
                                    <tr>
                                        <td> {{  $provedor->nombre_provedor  }} </td>
                                        <td> {{  $provedor->direccion  }} </td>
                                        <td> {{  $provedor->correo  }} </td>
                                        <td> {{  $provedor->id_categoria  }} </td>
                                        <td> {{  $provedor->id_empresa  }} </td>
                                        <td> {{  $provedor->nombre_empresa  }} </td>
                                        <td> {{  $provedor->razon_social  }} </td>
                                        <td> {{  $provedor->telefono  }} </td>
                                        <td> {{  $provedor->id_Estatus_provedor  }} </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="9"><div class="alert alert-danger" role="alert">
                                            No se encointraron registros!
                                          </div></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
