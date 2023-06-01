<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Lib: Encriptar contraseñar
use Illuminate\Support\MessageBag; // Lib: Mensajes de Error
use Barryvdh\DomPDF\Facade\Pdf; // Lib: Generar PDF

class UserController extends Controller
{
    public function index() // Muestra la lista de usuarios
    {
        $users = User::all();

        return view('users.index')->with('users', $users);
    }

    public function create() // Carga la vista para crear usuarios
    {
        return view('users.create');
    }

    public function store(Request $request) // Crea un usuario
    {
        $request->validate([
            'matricula' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:255'],
            'apellido_materno' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'licenciatura' => ['required', 'string', 'max:255'],
            'tipo_usuario' => ['required', 'string', 'max:255']
        ]);

        User::create([
            'matricula' => $request->matricula,
            'name' => $request->name,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'licenciatura' => $request->licenciatura,
            'tipo_usuario' => $request->tipo_usuario
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario Creado Correctamente.');
    }

    public function edit(User $user) // Carga la vista para editar usuarios
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user) // Actualiza un usuario
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:255'],
            'apellido_materno' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'licenciatura' => ['required', 'string', 'max:255'],
            'tipo_usuario' => ['required', 'string', 'max:255']
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Usuario Actualizado Correctamente.');
    }

    public function destroy(User $user) // Elimina un usuario
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario Eliminado Correctamente.');
    }

    public function show(User $user) // Carga la vista para mostrar usuarios 
    {
        return view('users.show', compact('user'));
    }

    public function cargarSaldo(Request $request, $cantidad) // Función para la carga de saldo
    {
        // Instancia de MessageBag
        $errors = new MessageBag();

        // Extraemos los datos del formulario
        $matricula = $request->input('matricula');
        $cantidad = $request->input('cantidad');

        // Busca el usuario en la base de datos
        $usuario = User::where('matricula', $matricula)->first();

        // Si encuentra un usuario...
        if ($usuario) {
            if (is_numeric($cantidad)) { // Si el valor es númerico
                // Incrementa el saldo del usuario
                $usuario->saldo += $cantidad;

                // Guarda la transacción
                $usuario->save();

                return redirect()->route('users.index')->with('success', 'Se Agrego El Saldo Correctamente.');
            }
            $errors->add('Error', 'Lo que ingresaste no es un valor número.');

            return redirect()->back()->withErrors($errors);
        } else {
            // Error en la transacción
            $errors->add('Error', 'La matrícula que ingresaste no se encuentra en los registros.');

            return redirect()->back()->withErrors($errors);
        }
    }

    public function cargarSaldoModal(Request $request) // Función para la carga de saldo desde modal
    {
        // Instancia de MessageBag
        $errors = new MessageBag();

        // Extraemos los datos del formulario
        $matricula = $request->input('matricula');
        $cantidad = $request->input('cantidad');

        // Busca el usuario en la base de datos
        $usuario = User::where('matricula', $matricula)->first();

        // Si encuentra un usuario...
        if ($usuario) {
            if (is_numeric($cantidad)) { // Si el valor es númerico
                // Incrementa el saldo del usuario
                $usuario->saldo += $cantidad;

                // Guarda la transacción
                $usuario->save();

                return redirect()->route('users.index')->with('success', 'Se Agrego El Saldo Correctamente.');
            }
            $errors->add('Error', 'Lo que ingresaste no es un valor número.');

            return redirect()->back()->withErrors($errors);
        } else {
            // Error en la transacción
            $errors->add('Error', 'La matrícula que ingresaste no se encuentra en los registros.');

            return redirect()->back()->withErrors($errors);
        }
    }

    public function quitarSaldoModal(Request $request) // Función para quitar saldo desde modal
    {
        // Instancia de MessageBag
        $errors = new MessageBag();

        // Extraemos los datos del formulario
        $matricula = $request->input('matricula');
        $cantidad = $request->input('cantidad');

        // Busca el usuario en la base de datos
        $usuario = User::where('matricula', $matricula)->first();

        // Si encuentra un usuario...
        if ($usuario) {
            if (is_numeric($cantidad)) { // Si el valor es númerico
                if ($usuario->saldo == 0) { // No se puede reirar un saldo menor a 0
                    $errors->add('Error', 'El usuario no cuenta con saldo.');

                    return redirect()->back()->withErrors($errors);
                } else {
                    // Incrementa el saldo del usuario
                    $usuario->saldo -= $cantidad;

                    // Guarda la transacción
                    $usuario->save();

                    return redirect()->route('users.index')->with('success', 'Se Quito El Saldo Correctamente.');
                }
            }
            $errors->add('Error', 'Lo que ingresaste no es un valor número.');

            return redirect()->back()->withErrors($errors);
        } else {
            // Error en la transacción
            $errors->add('Error', 'La matrícula que ingresaste no se encuentra en los registros.');

            return redirect()->back()->withErrors($errors);
        }
    }

    public function generarPDF() // Genera PDF del registro de impresiones
    {
        /*
            Testing
        */
        $users = User::all(); // Se extrae lo que se quiere mostrar

        // Se carga el contenido del PDF desde una vista
        $pdf = PDF::loadView('users.create-report', compact('users'));

        return $pdf->download('Reporte.pdf'); // Salida del PDF
    }
}