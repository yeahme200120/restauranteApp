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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Editar Provedor') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/updateProvedor">
                            @csrf
                            <input type="hidden" value="{{$provedor->id}}" name="id">
                            <div class="row">
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="nombre_provedor"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                    <input id="nombre_provedor" type="text"
                                        class="form-control @error('nombre_provedor') is-invalid @enderror" name="nombre_provedor"
                                        value="{{ $provedor->nombre_provedor  }}" required autocomplete="name" autofocus>

                                    @error('nombre_provedor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="direccion"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Direccion') }}</label>
                                    <input id="direccion" type="text"
                                        class="form-control @error('direccion') is-invalid @enderror" name="direccion"
                                        value="{{ $provedor->direccion }}" required autocomplete="name" autofocus>

                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="correo"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>
                                    <input id="correo" type="email"
                                        class="form-control @error('correo') is-invalid @enderror" name="correo"
                                        value="{{ $provedor->correo }}" required autocomplete="name" autofocus>

                                    @error('correo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="id_categoria"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Categoria') }}</label>
                                    <select name="id_categoria" id="id_categoria" class="form-control  @error('id_categoria') is-invalid @enderror">
                                        @foreach ($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{ $categoria->categoria_producto}} </option>
                                        @endforeach
                                    </select>
                                    @error('id_categoria')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="id_empresa"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Empresa') }}</label>
                                        <select name="id_empresa" id="id_empresa" class="form-control  @error('id_empresa') is-invalid @enderror">
                                            @foreach ($empresas as $empresa)
                                                <option value="{{$empresa->id}}">{{ $empresa->nombre_empresa}} </option>
                                            @endforeach
                                        </select>
                                    @error('id_empresa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="nombre_empresa"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Empresa Provedor') }}</label>
                                    <input id="nombre_empresa" type="text"
                                        class="form-control @error('nombre_empresa') is-invalid @enderror" name="nombre_empresa"
                                        value="{{ $provedor->nombre_empresa }}" required autocomplete="name" autofocus>

                                    @error('nombre_empresa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="razon_social"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Razon Social') }}</label>
                                    <input id="razon_social" type="text"
                                        class="form-control @error('razon_social') is-invalid @enderror" name="razon_social"
                                        value="{{ $provedor->razon_social }}" required autocomplete="name" autofocus readonly>

                                    @error('razon_social')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="telefono"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Telefono') }}</label>
                                    <input id="telefono" type="text"
                                        class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                        value="{{ $provedor->telefono }}" required autocomplete="name" autofocus>

                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="id_Estatus_provedor"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Estatus') }}</label>
                                    <select name="id_Estatus_provedor" id="id_Estatus_provedor" class="form-control  @error('id_Estatus_provedor') is-invalid @enderror">
                                        @foreach ($estatusProv as $estatus)
                                            <option value="{{$estatus->id}}">{{ $estatus->estatus_provedor}} </option>
                                        @endforeach
                                    </select>
                                    @error('id_Estatus_provedor')
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
                                {{ __('Registrar Provedor') }}
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
