@extends('layouts.app')

@section('content')
    <script src="{{ asset('../../js/peticionesAjax.js') }}"></script>

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
    <script src=""></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-4">
                                {{ __('Registrar nueva empresa') }}
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/registrarEmpresa" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="codigo_postal">CP</label>
                                    <input class="form-control  @error('codigo_postal') is-invalid @enderror" type="number"
                                        id="codigo_postal" value="{{ old('codigo_postal') }}" name="codigo_postal" required>
                                    @error('codigo_postal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 p-3">
                                    <button onclick="buscarCP()" class="btn btn-info">Buscar Codigo postal</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 p-1">
                                    <label for="pais">PAIS</label>
                                    <input class="form-control  @error('pais') is-invalid @enderror" type="text"
                                        id="pais" value="{{ old('pais') }}" name="pais" required>
                                    @error('pais')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 p-1">
                                    <label for="ciudad">CIUDAD</label>
                                    <input class="form-control  @error('ciudad') is-invalid @enderror" type="text"
                                        id="ciudad" value="{{ old('ciudad') }}" name="ciudad" required>
                                    @error('ciudad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 p-1">
                                    <label for="domicilio_fiscal">DOMICILIO (CALLE Y NUMERO)</label>
                                    <input class="form-control  @error('domicilio_fiscal') is-invalid @enderror"
                                        type="text" value="{{ old('domicilio_fiscal') }}" name="domicilio_fiscal"
                                        required>
                                    @error('domicilio_fiscal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 p-1">
                                    <label for="giro">GIRO</label>
                                    <input class="form-control  @error('giro') is-invalid @enderror" type="text"
                                        value="{{ old('giro') }}" name="giro" required>
                                    @error('giro')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 p-1">
                                    <label for="nombre_empresa">NOMBRE</label>
                                    <input class="form-control  @error('nombre_empresa') is-invalid @enderror"
                                        type="text" value="{{ old('nombre_empresa') }}" name="nombre_empresa" required>
                                    @error('nombre_empresa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 p-1">
                                    <label for="razon_social">RAZON SOCIAL</label>
                                    <input class="form-control  @error('razon_social') is-invalid @enderror" type="text"
                                        value="{{ old('razon_social') }}" name="razon_social" required>
                                    @error('razon_social')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 p-1">
                                    <label for="RFC">RFC</label>
                                    <input class="form-control  @error('RFC') is-invalid @enderror" type="text"
                                        value="{{ old('RFC') }}" name="RFC" required>
                                    @error('RFC')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 p-1">
                                    <label for="estatus_empresa">ESTATUS</label>
                                    <select id=""
                                        class="form-control  @error('estatus_empresa') is-invalid @enderror"
                                        value="{{ old('estatus_empresa') }}" name="estatus_empresa">
                                        <option value="" disabled selected>Selecciona una opcion....</option>
                                        @foreach ($estatus as $es)
                                            <option value="{{ $es->id }}">{{ $es->estado_empresa }}</option>
                                        @endforeach
                                    </select>
                                    @error('estatus_empresa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center p-1">
                                <div class="col-12 col-md-3">
                                    <button class="btn btn-primary">Registrar empresa</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script></script>
@endsection
