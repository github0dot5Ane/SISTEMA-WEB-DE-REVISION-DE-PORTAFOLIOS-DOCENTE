<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Revision; 
use App\Models\Portafolio; 
use App\Models\CargaAcademica;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;

class RevisorController extends Controller
{
    public function index()
    {
        return view('revisor.dashboard'); // Asegúrate de crear esta vista
    }
    // Controlador para la asignación de revisores
public function asignarRevisores()
{
    // Obtener los usuarios que son revisores o administradores
    $usuariosRevisores = User::where(function($query) {
        $query->where('es_revisor', 1)
              ->orWhere('es_administrador', 1);
    })->get();

    // Obtener todas las revisiones
    $revisiones = Revision::all();

    // Retornar vista con los datos necesarios
    return view('admin.asignar_revisores', compact('usuariosRevisores', 'revisiones'));
}

public function actualizarRevisor(Request $request)
{
    // Validar los datos recibidos
    $request->validate([
        'id_revisor_usuario' => 'required|exists:users,id',
        'revision_id' => 'required|exists:revisiones,id',
    ]);

    // Obtener la revisión seleccionada
    $revision = Revision::find($request->revision_id);
    
    // Asignar el revisor a la revisión
    $revision->id_usuario_revisor = $request->id_revisor_usuario;
    $revision->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('admin.asignar.revisores')->with('success', 'Revisor asignado exitosamente.');
}
// Function to display all revisions for the logged-in user

public function mostrarRevisiones()
{
    // Obtener el usuario logueado
    $usuarioLogueado = Auth::id();

    // Obtener todas las revisiones del usuario logueado
    $revisiones = Revision::where('id_usuario_revisor', $usuarioLogueado)->get();

    $datosRevisiones = $revisiones->map(function ($revision) {
        // Validar la existencia de los registros relacionados
        $portafolio = Portafolio::find($revision->id_portafolio);
        $usuario = $portafolio ? User::find($portafolio->id_usuario) : null;
        $cargaAcademica = $portafolio ? CargaAcademica::find($portafolio->id_carga) : null;
        $curso = $cargaAcademica ? Curso::where('id_curso', $cargaAcademica->id_curso)->first() : null;

        return [
            'revision' => $revision,
            'nombre_usuario' => $usuario ? $usuario->name : 'Desconocido',
            'nombre_curso' => $curso ? $curso->nombre : 'No asignado',
        ];
    });

    return view('revisor.revisiones', compact('datosRevisiones'));
}



    public function guardarObservacion(Request $request, $idRevision)
    {
        
        // Validar que el campo comentarios esté presente
        $request->validate([
            'comentarios' => 'required|string',
        ]);

        // Buscar la revisión
        $revision = Revision::find($idRevision);
        if (!$revision) {
            return redirect()->back()->with('error', 'Revisión no encontrada.');
        }

        // Actualizar comentarios
        $revision->comentarios = $request->comentarios;
        $revision->save();

        return redirect()->route('revisor.dashboard')->with('success', 'Observación guardada correctamente.');
    
    }

    
}
