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
                            <b>{{ __('Insumos') }}</b>
                        </div>
                        <div class="col-1 text-center" data-toggle="tooltip" data-placement="top" title="Agregar Insumo">
                            <a href="/registrarInsumos" class="text-success" >
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
                                        <th> Descripcion</th>
                                        <th> Area</th>
                                        <th> Precio Unitario</th>
                                        <th> IVA</th>
                                        <th> Unidad</th>
                                        <th> Cantidad</th>
                                        <th> Empresa</th>
                                        <th> Provedor</th>
                                        <th> Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset( $insumos ))
                                    @foreach ($insumos as $insumo)
                                    <tr>
                                        <td> {{  $insumo->descripcion  }} </td>
                                        <td> {{  $insumo->id_area_insumo  }} </td>
                                        <td> {{  $insumo->precio_unitario  }} </td>
                                        <td> {{  $insumo->iva  }} </td>
                                        <td> {{  $insumo->id_unidad  }} </td>
                                        <td> {{  $insumo->cantidad  }} </td>
                                        <td> {{  $insumo->id_empresa  }} </td>
                                        <td> {{  $insumo->id_provedor  }} </td>
                                        <td> {{  ($insumo->estatus == 0) ? "Activo" : "Eliminado"  }} </td>
                                        <td>
                                            <div class="row">
                                                <div class="col" data-toggle="tooltip" data-placement="top" title="Editar producto {{$insumo->nombre_producto}} ">
                                                    <a href="/editarInsumos/{{$insumo->id}}">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="col" data-toggle="tooltip" data-placement="top" title="Eliminar producto {{$insumo->nombre_producto}}">
                                                    <a href="/eliminarInsumos/{{$insumo->id}}">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
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
