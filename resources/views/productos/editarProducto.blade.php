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
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Actualizar Producto') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/updateProducto">
                            @csrf
                            <input type="hidden" name="id" value="{{$producto->id}}">
                            <div class="row">
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="nombre_producto"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                    <input id="nombre_producto" type="text"
                                        class="form-control @error('nombre_producto') is-invalid @enderror" name="nombre_producto"
                                        value="{{ $producto->nombre_producto }}" required autocomplete="name" autofocus>

                                    @error('nombre_producto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="precio_compra"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Precio Compra') }}</label>
                                    <input id="precio_compra" type="number" step=".01" min="1"
                                        class="form-control @error('precio_compra') is-invalid @enderror" name="precio_compra"
                                        value="{{ $producto->precio_compra }}" required autocomplete="name" autofocus>

                                    @error('precio_compra')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="precio_venta"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Precio Venta') }}</label>
                                    <input id="precio_venta" type="number" step=".01" min="1"
                                        class="form-control @error('precio_venta') is-invalid @enderror" name="precio_venta"
                                        value="{{ $producto->precio_venta }}" required autocomplete="name" autofocus>

                                    @error('precio_venta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="id_provedor"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Provedor') }}</label>
                                        <select name="id_provedor" id="id_provedor" class="form-control">
                                            @foreach ($provedores as $provedor)
                                                <option value="{{$provedor->id}}">{{$provedor->nombre_provedor}} </option>
                                            @endforeach
                                        </select>
                                    @error('id_provedor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="stock"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Stock') }}</label>
                                    <input id="stock" type="number" step=".01" min="1" class="form-control @error('stock') is-invalid @enderror" name="stock"
                                        value="{{ $producto->stock }}" required autocomplete="name" autofocus>

                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="iva"
                                        class="col-md-4 col-form-label text-md-end">{{ __('IVA') }}</label>
                                    <input id="iva" type="number" step=".01" min="0"
                                        class="form-control @error('iva') is-invalid @enderror" name="iva"
                                        value="{{ $producto->iva }}" required autocomplete="name" autofocus>

                                    @error('iva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="id_empresa"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Empresa') }}</label>
                                        <select name="id_empresa" id="id_empresa" class="form-control">
                                            @foreach ($empresas as $empresa)
                                                <option value="{{$empresa->id}}">{{$empresa->nombre_empresa}} </option>
                                            @endforeach
                                        </select>
                                    @error('id_empresa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="id_estatus_producto"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Estatus') }}</label>
                                    <select name="id_estatus_producto" id="id_estatus_producto" class="form-control">
                                        @foreach ($estatus as $estatus)
                                            <option value="{{$estatus->id}}">{{$estatus->estatus_producto}} </option>
                                        @endforeach
                                    </select>
                                    @error('id_estatus_producto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="id_categoria"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Categoria') }}</label>
                                        <select name="id_categoria" id="id_categoria" class="form-control">
                                            @foreach ($categorias as $categoria)
                                                <option value="{{$categoria->id}}">{{$categoria->categoria_producto}} </option>
                                            @endforeach
                                        </select>
                                    @error('id_categoria')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="id_unidad"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Unidad') }}</label>
                                    <select name="unidad" id="unidad" class="form-control">
                                        @foreach ($unidades as $unidad)
                                            <option value="{{$unidad->id}}">{{$unidad->nombre_unidad}} </option>
                                        @endforeach
                                    </select>
                                    @error('unidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="row justify-content-center p-2">
                        <div class="col-6 col-md-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Actualizar Producto') }}
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
