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
                <form method="POST" action="/updateInsumos">
                    <div class="card">
                        <div class="card-header">{{ __('Editar Insumos') }}</div>

                        <div class="card-body">
                                @csrf
                                <div class="row">
                                    <input type="text" name="id" value="{{$insumo->id}}">
                                    <div class="col--12 col-md-6 p-1 text-center">
                                        <label for="descripcion"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Descripcion') }}</label>
                                        <input id="descripcion" type="text"
                                            class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                                            value="{{ $insumo->descripcion }}" required autocomplete="name" autofocus>

                                        @error('descripcion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col--12 col-md-6 p-1 text-center">
                                        <label for="id_area_almacen"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Area') }}</label>
                                            <select name="id_area_almacen" id="id_area_almacen" class="form-control  @error('id_area_almacen') is-invalid @enderror">
                                                @foreach ($areas as $area )
                                                    <option value="{{$area->id}}">{{$area->nombre_area}} </option>
                                                @endforeach
                                            </select>
                                        @error('id_area_almacen')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col--12 col-md-6 p-1 text-center">
                                        <label for="precio_unitario"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Precio') }}</label>
                                        <input id="precio_unitario" type="number" step=".01" min="1"
                                            class="form-control @error('precio_unitario') is-invalid @enderror" name="precio_unitario"
                                            value="{{ $insumo->precio_unitario }}" required autocomplete="name" autofocus>

                                        @error('precio_unitario')
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
                                            value="{{ $insumo->iva }}" required autocomplete="name" autofocus>

                                        @error('iva')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col--12 col-md-6 p-1 text-center">
                                        <label for="id_unidad"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Unidad') }}</label>
                                            <select name="id_unidad" id="id_unidad" class="form-control  @error('id_unidad') is-invalid @enderror">
                                                @foreach ($unidades as $unidad )
                                                    <option value="{{$unidad->id}}">{{$unidad->nombre_unidad}} </option>
                                                @endforeach
                                            </select>
                                        @error('id_unidad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col--12 col-md-6 p-1 text-center">
                                        <label for="cantidad"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Cantidad') }}</label>
                                        <input id="cantidad" type="number" min="1"
                                            class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                            value="{{ $insumo->cantidad }}" required autocomplete="name" autofocus>

                                        @error('cantidad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col--12 col-md-6 p-1 text-center">
                                        <label for="id_empresa"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Empresa') }}</label>
                                            <select name="id_empresa" id="id_empresa" class="form-control  @error('id_empresa') is-invalid @enderror">
                                                @foreach ($empresas as $empresa )
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
                                        <label for="id_provedor"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Provedor') }}</label>
                                            <select name="id_provedor" id="id_provedor" class="form-control  @error('id_provedor') is-invalid @enderror">
                                                @foreach ($provedores as $provedor )
                                                    <option value="{{$provedor->id}}">{{$provedor->nombre_provedor}} </option>
                                                @endforeach
                                            </select>
                                        @error('id_provedor')
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
                                    {{ __('Actualizar Insumo') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
