@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                {{-- Mensajes --}}
                @if ($message = Session::get('success'))
                    <div class="alert alert-success text-center">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                {{-- Mensajes de error --}}
                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="h6 mt-2">➤ Todos Los Usuarios</p>
                            </div>
                            <div class="col-md-6 d-flex flex-row-reverse">
                                <a href="{{ route('crear-reporte') }}" class="btn btn-dark btn-sm mx-2">Crear Reporte</a>
                                <!-- Quitar Saldo Modal -->
                                <button type="button" class="btn btn-danger btn-sm mx-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal01">
                                    Quitar Saldo
                                </button>

                                <!-- Modal Quitar Saldo -->
                                <div class="modal fade" id="exampleModal01" tabindex="-1"
                                    aria-labelledby="exampleModal01Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModal01Label">Quitar Saldo Para
                                                    Impresiones
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.quitarSaldoModal') }}" method="POST">
                                                    @csrf

                                                    <div class="row">
                                                        {{-- Matrícula --}}
                                                        <div class="col-md-12 mb-2">
                                                            <div class="form-outline">
                                                                <label class="form-label" for="matricula">Matrícula /
                                                                    Clave</label>
                                                                <input type="text" id="matricula" class="form-control"
                                                                    placeholder="Matrícula" name="matricula" required
                                                                    autofocus />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        {{-- Cantidad --}}
                                                        <label class="form-label" for="cantidad">Cantidad</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" id="cantidad" class="form-control"
                                                                placeholder="0.00" name="cantidad" required />
                                                        </div>
                                                    </div>

                                                    {{-- Submit --}}
                                                    <div class="pt-2">
                                                        <input class="btn btn-danger btn-lg" type="submit"
                                                            value="Quitar Saldo" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Cargar Saldo Modal -->
                                <button type="button" class="btn btn-success btn-sm mx-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Cargar Saldo
                                </button>

                                <!-- Modal Cargar Saldo -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cargar Saldo Para Impresiones
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.cargarSaldoModal') }}" method="POST">
                                                    @csrf

                                                    <div class="row">
                                                        {{-- Matrícula --}}
                                                        <div class="col-md-12 mb-2">
                                                            <div class="form-outline">
                                                                <label class="form-label" for="matricula">Matrícula /
                                                                    Clave</label>
                                                                <input type="text" id="matricula" class="form-control"
                                                                    placeholder="Matrícula" name="matricula" required
                                                                    autofocus />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        {{-- Cantidad --}}
                                                        <label class="form-label" for="cantidad">Cantidad</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" id="cantidad" class="form-control"
                                                                placeholder="0.00" name="cantidad" required />
                                                        </div>
                                                    </div>

                                                    {{-- Submit --}}
                                                    <div class="pt-2">
                                                        <input class="btn btn-success btn-lg" type="submit"
                                                            value="Cargar Saldo" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mx-2">Agregar Usuario</a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Matrícula</th>
                                    <th scope="col">Nombre(s)</th>
                                    <th scope="col">A. Paterno</th>
                                    <th scope="col">A. Materno</th>
                                    <th scope="col">Tipo De Usuario</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col" width="300px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->matricula }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->apellido_paterno }}</td>
                                        <td>{{ $user->apellido_materno }}</td>
                                        <td>{{ $user->tipo_usuario }}</td>
                                        <td>$ {{ $user->saldo }}</td>
                                        <td>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('users.edit', $user->id) }}">Editar</a>
                                                {{-- Editar Usuario --}}
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('users.show', $user->id) }}">Cargar Saldo</a>
                                                {{-- Cargar Usuario --}}
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                {{-- Eliminar Usuario --}}
                                            </form>
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
@endsection
