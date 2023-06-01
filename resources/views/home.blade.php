@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('¡Bienvenido!') }}</div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Matrícula</th>
                                    <th scope="col">Nombre(s)</th>
                                    <th scope="col">A. Paterno</th>
                                    <th scope="col">A. Materno</th>
                                    <th scope="col">Licenciatura</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="row">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                <tr>
                                    <th scope="row">{{ Auth::user()->matricula }}</th>
                                    <td>{{ Auth::user()->name }}</td>
                                    <td>{{ Auth::user()->apellido_paterno }}</td>
                                    <td>{{ Auth::user()->apellido_materno }}</td>
                                    <td>{{ Auth::user()->licenciatura }}</td>
                                    <td>$ {{ Auth::user()->saldo }}</td>
                                    <td>
                                        {{-- Validación - Cuenta Con Saldo --}}
                                        @if (Auth::user()->saldo > 0)
                                            <a href="#" class="btn btn-success btn-sm">Imprimir</a>
                                        @else
                                            <!-- Cargar Saldo Modal -->
                                            <button type="button" class="btn btn-danger btn-sm mx-2" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Sin Saldo
                                            </button>

                                            <!-- Modal Cargar Saldo -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">¡Sin Saldo!
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>No cuentas con saldo para realizar impresiones.</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
