<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Revision;
use App\Models\Portafolio;
use App\Models\User;
use App\Models\Curso;
use App\Models\ItemsPractico;
use App\Models\ItemsTeorico;
use App\Models\CargaAcademica;
use App\Http\Requests\StoreRevisionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateRevisionRequest;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PortafoliosExport;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRevisionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Revision $revision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revision $revision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRevisionRequest $request, Revision $revision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revision $revision)
    {
        //
    }
    public function index()
    {
        try {
            // Obtener las revisiones
            $revisiones = Revision::all();
            
            // Obtener usuarios con los roles de administrador y revisor
            $usuarios = User::where('es_administrador', 1)
                                    ->orWhere('es_revisor', 1)
                                    ->get();
    
            // Recuperar el nombre del usuario asociado al id_portafolio
            foreach ($revisiones as $revision) {
                // Obtener el id_usuario desde la tabla portafolio utilizando el id_portafolio
                $portafolio = Portafolio::find($revision->id_portafolio);
                
                // Si el portafolio existe, recuperar el nombre del usuario asociado al portafolio
                if ($portafolio) {
                    $usuario = User::find($portafolio->id_usuario);
                    // Asignar el nombre del usuario o 'No asignado' si no existe
                    $revision->usuario_name = $usuario ? $usuario->name : 'No asignado';
                } else {
                    $revision->usuario_name = 'No asignado';
                }
            }
    
            return view('admin.revisiones.index', compact('revisiones', 'usuarios'));
        } catch (\Exception $e) {
            // Si ocurre algún error, captura la excepción y regresa un mensaje de error
            \Log::error("Error al obtener revisiones o usuarios: " . $e->getMessage());
            return response()->view('errors.500', [], 500); // Vista personalizada de error
        }
    }

    public function asignarRevisor(Request $request, $id)
{
    try {
        // Validar la solicitud
        $request->validate([
            'revisor_id' => 'required|exists:users,id', // Verifica que el revisor exista
        ]);

        // Encontrar la revisión y el portafolio asociado
        $revision = Revision::findOrFail($id);
        $portafolio = Portafolio::find($revision->id_portafolio); // Obtener el portafolio relacionado

        // Verificar si el revisor seleccionado es el mismo que el usuario asociado al portafolio
        if ($portafolio && $portafolio->id_usuario == $request->revisor_id) {
            // Si es el mismo, devolver un mensaje de error
            return response()->json(['error' => 'No se puede asignar el mismo usuario como revisor que como docente.'], 400);
        }

        // Asignar el revisor
        $revision->id_usuario_revisor = $request->revisor_id;
        $revision->save();

        return response()->json(['success' => 'Revisor asignado correctamente.']);
    } catch (\Exception $e) {
        // Captura cualquier error y muestra mensaje
        \Log::error("Error al asignar revisor: " . $e->getMessage());
        return response()->json(['error' => 'Ocurrió un error al asignar el revisor.'], 500);
    }
}




    public function registroActividades()
{
    // Recuperar las revisiones con los campos necesarios sin paginación
    $revisiones = Revision::select('id_portafolio', 'id_usuario_revisor', 'updated_at')->get();
    
    // Buscar los nombres de los revisores directamente en la tabla users
    foreach ($revisiones as $revision) {
        // Obtener el nombre del revisor
        $revision->revisor_name = User::find($revision->id_usuario_revisor)->name ?? 'No asignado';

        // Obtener el id_usuario desde la tabla portafolio utilizando el id_portafolio
        $portafolio = Portafolio::find($revision->id_portafolio);
        
        // Si el portafolio existe, recuperar el nombre del usuario asociado al portafolio
        if ($portafolio) {
            $usuario = User::find($portafolio->id_usuario);
            // Asignar el nombre del usuario o 'No asignado' si no existe
            $revision->usuario_name = $usuario ? $usuario->name : 'No asignado';
        } else {
            $revision->usuario_name = 'No asignado';
        }
    }

    return view('admin.revisiones.registro_actividades', compact('revisiones'));
}

    public function pendientesRevision()
{
    // Obtener el ID del usuario logueado
    $usuarioLogueado = Auth::id();

    // Buscar las revisiones donde el usuario actual es revisor
    $revisiones = Revision::where('id_usuario_revisor', $usuarioLogueado)
                            ->select('id_portafolio')
                            ->get();

    // Obtener los IDs de los portafolios
    $portafoliosIds = $revisiones->pluck('id_portafolio')->toArray();

    // Recuperar los portafolios donde el estado es 'pendiente' o 'corregir' y el usuario es revisor
    $portafolios = Portafolio::whereIn('id', $portafoliosIds)
                                ->whereIn('estado', ['pendiente', 'corregir'])
                                ->get();

    // Recuperar los datos necesarios para la vista
    $portafoliosConDatos = $portafolios->map(function($portafolio) {
        // Obtener el nombre del usuario (revisor)
        $usuarioRevisor = User::find($portafolio->id_usuario);

        // Obtener el nombre del curso utilizando el id_carga
        $curso = CargaAcademica::find($portafolio->id_carga);

        return [
            'id' => $portafolio->id,
            'nombre_usuario' => $usuarioRevisor ? $usuarioRevisor->name : 'No asignado',
            'id_curso' => $curso ? $curso->id_curso : 'No asignado',  // Aquí se obtiene el nombre del curso
            'tipo_curso' => $portafolio->tipo_curso, // Recuperamos el tipo de curso
            'estado' => $portafolio->estado,
            'updated_at' => $portafolio->updated_at ? $portafolio->updated_at->format('d-m-Y H:i') : 'No disponible',
        ];
    });

    // Pasar los datos a la vista
    return view('revisor.pendientes_revision', compact('portafoliosConDatos'));
}
public function generarInformes()
{
    $portafolios = Portafolio::select('id', 'id_usuario', 'id_carga')->get();
    // Recuperar los datos necesarios para la vista
    $portafoliosConDatos = $portafolios->map(function($portafolio) {
        // Obtener el nombre del usuario (revisor)
        $usuario = User::find($portafolio->id_usuario);
        // Obtener el nombre del curso utilizando el id_carga
        $cargaAcademica = CargaAcademica::find($portafolio->id_carga);
        $curso = $cargaAcademica ? Curso::where('id_curso', $cargaAcademica->id_curso)->first() : null;
        // Validar la existencia de los registros relacionados
        $revision = Revision::where('id_portafolio', $portafolio->id)->first();
        $usuariorevisor = User::find($revision->id_usuario_revisor);
        


        return [

            'nombre_docente' => $usuario ? $usuario->name : 'No asignado',
            'curso' => $curso ? $curso->nombre : 'No asignado',  // Aquí se obtiene el nombre del curso
            'nombre_revisor' => $usuariorevisor ? $usuariorevisor->name : 'No asignado', // Recuperamos el tipo de curso
            'resultado' => $revision ? $revision->resultado : 'No asignado',
            'comentarios' => $revision ? $revision->comentarios : 'No asignado',
            'updated_at' => $revision->updated_at ? $revision->updated_at->format('d-m-Y H:i') : 'No disponible',
        ];
    });

    return view('admin.portafolios.informes', compact('portafoliosConDatos'));
}
public function generarInformesExcel()
    {
        // Usamos la clase de exportación para generar el archivo Excel
        return Excel::download(new PortafoliosExport, 'informes_portafolios.xlsx');
    }


    






    






    
    
}
