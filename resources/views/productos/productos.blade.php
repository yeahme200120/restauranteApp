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
                            <b>{{ __('Productos') }}</b>
                        </div>
                        <div class="col-1 text-center" data-toggle="tooltip" data-placement="top" title="Agregar Producto">
                            <a href="/registrarProducto" class="text-success" >
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
                                        <th> Precio Compra</th>
                                        <th> Precio Venta</th>
                                        <th> Provedor</th>
                                        <th> Stock</th>
                                        <th> IVA</th>
                                        <th> Empresa</th>
                                        <th> Estatus</th>
                                        <th> Categoria</th>
                                        <th> Unidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset( $productos ))
                                    @foreach ($productos as $producto)
                                    <tr>
                                        <td> {{  $producto->nombre_producto  }} </td>
                                        <td> {{  $producto->precio_compra  }} </td>
                                        <td> {{  $producto->precio_venta  }} </td>
                                        <td> {{  $producto->provedor  }} </td>
                                        <td> {{  $producto->stock  }} </td>
                                        <td> {{  $producto->iva  }} </td>
                                        <td> {{  $producto->empresa  }} </td>
                                        <td> {{  $producto->estatus  }} </td>
                                        <td> {{  $producto->categoria  }} </td>
                                        <td> {{  $producto->unidad  }} </td>
                                        <td>
                                            <div class="row">
                                                <div class="col" data-toggle="tooltip" data-placement="top" title="Editar producto {{$producto->nombre_producto}} ">
                                                    <a href="/editarProducto/{{$producto->id}}">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="col" data-toggle="tooltip" data-placement="top" title="Eliminar producto {{$producto->nombre_producto}}">
                                                    <a href="/eliminarProducto/{{$producto->id}}">
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
