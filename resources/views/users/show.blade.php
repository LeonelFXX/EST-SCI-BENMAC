@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

                {{-- Mensajes de error --}}
                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">Cargar Saldo: {{ $user->name }}</div>
                    <div class="card-body">
                        <form action="{{ route('users.cargarSaldo', $user->id) }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- Matrícula --}}
                                <div class="col-md-12 mb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="matricula">Matrícula / Clave</label>
                                        <input type="text" id="matricula" class="form-control" placeholder="Matrícula"
                                            name="matricula" value="{{ $user->matricula }}" required autofocus />
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
                                    <input type="text" id="cantidad" class="form-control" placeholder="0.00"
                                        name="cantidad" required />
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="pt-2">
                                <input class="btn btn-success btn-lg" type="submit" value="Cargar Saldo" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
