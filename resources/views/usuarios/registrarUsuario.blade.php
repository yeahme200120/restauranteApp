@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Registrar Uusario') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/createUser">
                            @csrf
                            <div class="row">
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>


                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>


                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Area') }}</label>
                                    <select name="id_area" id="id_area"
                                        class="form-control @error('id_area') is-invalid @enderror">
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->nombre_area }} </option>
                                        @endforeach
                                    </select>

                                    @error('id_area')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Empresa') }}</label>

                                    <select name="id_empresa" id="id_empresa"
                                        class="form-control @error('id_empresa') is-invalid @enderror">
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nombre_empresa }} </option>
                                        @endforeach
                                    </select>
                                    @error('id_empresa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Estado') }}</label>

                                        <select name="id_estado_usuario" id="id_estado_usuario" class="form-control @error('id_estado_usuario') is-invalid @enderror">
                                            @foreach ($estados as $estado )
                                                <option value="{{$estado->id}}">{{ $estado->estado_usuario}} </option>
                                            @endforeach
                                        </select>
                                    @error('id_estado_usuario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Licencia') }}</label>

                                        <select name="id_licencia" id="id_licencia" class="form-control @error('id_licencia') is-invalid @enderror">
                                            @foreach ($licencias as $licencia )
                                                <option value="{{$licencia->id}}">{{ $licencia->descripcion_tipo_licencia}} </option>
                                            @endforeach
                                        </select>
                                    @error('id_licencia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>

                                        <select name="id_rol" id="id_rol" class="form-control @error('id_rol') is-invalid @enderror">
                                            @foreach ($roles as $rol )
                                                <option value="{{$rol->id}}">{{ $rol->rol_usuario}} </option>
                                            @endforeach
                                        </select>
                                    @error('id_rol')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Pagina') }}</label>


                                    <input id="name" type="text"
                                        class="form-control @error('pagina_web') is-invalid @enderror" name="pagina_web"
                                        value="{{ old('pagina_web') }}" required autocomplete="pagina_Web" autofocus>

                                    @error('pagina_web')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Telefono') }}</label>


                                    <input id="name" type="text"
                                        class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                        value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>

                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col--12 col-md-6 p-1 text-center">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Turno') }}</label>

                                        <select name="id_turno" id="id_turno" class="form-control @error('id_turno') is-invalid @enderror">
                                            @foreach ($turnos as $turno )
                                                <option value="{{$turno->id}}">{{ $turno->turno}} </option>
                                            @endforeach
                                        </select>

                                    @error('id_turno')
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
                                {{ __('Registrar Usuario') }}
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
