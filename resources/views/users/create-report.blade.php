<div style="text-align: center;">
    <table border="1" style="margin: 0 auto;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Matrícula</th>
                <th scope="col">Nombre(s)</th>
                <th scope="col">A. Paterno</th>
                <th scope="col">A. Materno</th>
                <th scope="col">Tipo De Usuario</th>
                <th scope="col">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->matricula }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->apellido_paterno }}</td>
                    <td>{{ $user->apellido_materno }}</td>
                    <td>{{ $user->tipo_usuario }}</td>
                    <td>$ {{ $user->saldo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>