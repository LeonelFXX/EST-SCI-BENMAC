@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Editar Datos Del Usuario') }}</div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- Matrícula --}}
                                <div class="col-md-3 mb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="matricula">Matrícula | Clave</label>
                                        <input type="text" id="matricula" class="form-control form-control-lg"
                                            placeholder="Matrícula" name="matricula" value="{{ $user->matricula }}" required
                                            autofocus disabled/>
                                    </div>
                                </div>

                                {{-- Nombre --}}
                                <div class="col-md-3 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="name">Nombre</label>
                                        <input type="text" id="name"
                                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                                            placeholder="Nombre(s)" name="name" value="{{ $user->name }}" required />
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Apellido Paterno --}}
                                <div class="col-md-3 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="apellidoPaterno">Apellido Paterno</label>
                                        <input type="text" id="apellidoPaterno" class="form-control form-control-lg"
                                            placeholder="A. Paterno" name="apellido_paterno"
                                            value="{{ $user->apellido_paterno }}" required />
                                    </div>
                                </div>

                                {{-- Apellido Materno --}}
                                <div class="col-md-3 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="apellidoMaterno">Apellido Materno</label>
                                        <input type="text" id="apellidoMaterno" class="form-control form-control-lg"
                                            placeholder="A. Materno" name="apellido_materno"
                                            value="{{ $user->apellido_materno }}" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- Teléfono --}}
                                <div class="col-md-3 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="phoneNumber">Télefono</label>
                                        <input type="tel" id="phoneNumber" class="form-control form-control-lg"
                                            placeholder="Télefono" name="telefono" value="{{ $user->telefono }}" required />
                                    </div>
                                </div>

                                {{-- Correo Electrónico --}}
                                <div class="col-md-9 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="emailAddress">Correo Electrónico</label>
                                        <input type="email" id="emailAddress"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            placeholder="Correo Electrónico" name="email" value="{{ $user->email }}"
                                            required />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- Licenciatura --}}
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Licenciatura</label>
                                    <select class="form-select" id="inputGroupSelect01" name="licenciatura" required>
                                        <option selected disabled>Escoge Una Opción...</option>
                                        <option value="TI">TI</option>
                                        <option value="Mercadotecnia">Mercadotecnia</option>
                                        <option value="Enfermería">Enfermería</option>
                                    </select>
                                </div>

                                {{-- Tipo Usuario --}}
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect02">Tipo De Usuario</label>
                                    <select class="form-select" id="inputGroupSelect02" name="tipo_usuario" required>
                                        <option selected disabled>Escoge Una Opción...</option>
                                        <option value="Estudiante">Estudiante</option>
                                        <option value="Personal Administrativo">Personal Administrativo</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="mt-2 pt-2">
                                <input class="btn btn-primary btn-lg" type="submit" value="Actualizar Usuario" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
