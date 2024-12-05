<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mostrar la lista de usuarios
    public function index()
    {
        $users = User::all(); // Se puede usar paginate() para paginación si es necesario
        return view('admin.usuarios.index', compact('users'));
    }

    // Mostrar el formulario de creación de usuario
    public function create()
    {
        return view('admin.usuarios.create');
    }
    public function updateStatus($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->activo = $request->activo;
        $user->save();

        return response()->json(['success' => true]);
    }



  
    // Mostrar los detalles del usuario
    public function show(User $user)
    {
        return response()->json($user);
    }

    // Mostrar el formulario de edición del usuario
    public function edit(User $user)
    {
        return response()->json($user);
    }

    // Actualizar el usuario
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user);
    }


    // Guardar un nuevo usuario
    public function store(Request $request)
    {
        try {
            // Validar los datos enviados
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'es_administrador' => 'nullable|boolean',
                'es_revisor' => 'nullable|boolean',
                'active' => 'required|boolean', // Asegura que "active" sea booleano
            ]);

            // Crear el nuevo usuario
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->es_administrador = $request->has('es_administrador');
            $user->es_revisor = $request->has('es_revisor');
            $user->activo = $request->active; // Tomar el valor directamente del formulario
            $user->save();

            // Retornar una respuesta JSON exitosa
            return response()->json(['message' => 'Usuario creado correctamente'], 200);
        } catch (\Exception $e) {
            // Manejar el error
            \Log::error('Error al crear usuario: ' . $e->getMessage());

            return response()->json(['message' => 'Hubo un problema al guardar el usuario. Por favor, inténtalo de nuevo.'], 500);
        }
    }


    

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente.']);
    }
}