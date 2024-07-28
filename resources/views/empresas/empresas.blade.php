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
                                {{ __('Empresas') }}
                            </div>
                            <a href="/setEmpresa" class="col-1 text-center text-success" data-toggle="tooltip"
                                data-placement="left" title="Registrar nueva empresa">
                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                            </a>
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
                                        <th class="text-center">id</th>
                                        <th class="text-center">Ciudad</th>
                                        <th class="text-center">CP</th>
                                        <th class="text-center">DOMICILIO</th>
                                        <th class="text-center">GIRO</th>
                                        <th class="text-center">NOMBRE</th>
                                        <th class="text-center">RAZON SOCIAL</th>
                                        <th class="text-center">RFC</th>
                                        <th class="text-center">PAIS</th>
                                        <th class="text-center">ESTATUS</th>
                                        <th class="text-center">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empresas as $empresa)
                                        <tr>
                                            <td class="text-center">{{ $empresa->id }} </td>
                                            <td>{{ $empresa->ciudad }} </td>
                                            <td class="text-center">{{ $empresa->codigo_postal }} </td>
                                            <td>{{ $empresa->domicilio_fiscal }} </td>
                                            <td>{{ $empresa->giro }} </td>
                                            <td>{{ $empresa->nombre_empresa }} </td>
                                            <td>{{ $empresa->razon_social }} </td>
                                            <td class="text-center">{{ $empresa->RFC }} </td>
                                            <td class="text-center">{{ $empresa->pais }} </td>
                                            <td class="text-center">{{ $empresa->estatus_empresa }} </td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="col-1" data-toggle="tooltip" data-placement="top"
                                                        title="Editar empresa ">
                                                        <a href="/editarEmpresa/{{$empresa->id}}">
                                                            <i class="fa fa-pencil-square text-warning" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-1" data-toggle="tooltip" data-placement="bottom"
                                                        title="Eliminar empresa">
                                                        <a href="/eliminarEmpresa/{{$empresa->id}}">
                                                            <i class="fa fa-eraser text-danger" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
