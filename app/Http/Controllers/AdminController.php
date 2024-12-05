<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Revision; 

class AdminController extends Controller
{
    public function index()
    {
        
        return view('admin.dashboard'); // Asegúrate de crear esta vista
    }
     // Mostrar el formulario para crear portafolios
     public function mostrarFormularioCrearPortafolios()
     {
         return view('admin.crear_portafolios');
     }
 
     // Crear los portafolios
     public function crearPortafolios(Request $request)
     {
         // Crear portafolios para cada carga académica
         $cargasAcademicas = CargaAcademica::all();
         
         foreach ($cargasAcademicas as $carga) {
             // Crear Portafolio
             $portafolio = Portafolio::create([
                 'id_usuario' => $carga->id_usuario,
                 'id_carga' => $carga->id_carga,
                 'fecha_subida' => now(),
                 'estado' => 'Pendiente',
                 'id_semestre' => $carga->id_semestre,
                 'caratula' => 0,
                 'carga_lectiva' => 0,
                 'filosofia' => 0,
                 'cv' => 0,
                 'silabo' => 0,
                 'tipo_curso' => $carga->es_teorico,
             ]);
 
             // Crear la tabla de items dependiendo si es teórico o práctico
             if ($carga->es_teorico == 1) {
                 ItemsTeorico::create([
                     'id_portafolio' => $portafolio->id_portafolio,
                     'avance_academico' => 0,
                     'registro_entrega_silabo' => 0,
                     'informe_examen_entrada' => 0,
                     'enunciado_y_solucion_exameN_1P' => 0,
                     'enunciado_y_solucion_exameN_2P' => 0,
                     'enunciado_y_solucion_exameN_3P' => 0,
                     'evidencia_actividades' => 0,
                     'registro_asistencia_1P' => 0,
                     'registro_asistencia_2P' => 0,
                     'registro_asistencia_3P' => 0,
                     'registro_notas_1P' => 0,
                     'registro_notas_2P' => 0,
                     'registro_notas_3P' => 0,
                     'cierre_portafolio' => 0,
                 ]);
             } else {
                 ItemsPractico::create([
                     'id_portafolio' => $portafolio->id_portafolio,
                     'avance_academico' => 0,
                     'evidencia_actividades' => 0,
                     'registro_asistencia_1P' => 0,
                     'registro_asistencia_2P' => 0,
                     'registro_asistencia_3P' => 0,
                     'registro_notas_1P' => 0,
                     'registro_notas_2P' => 0,
                     'registro_notas_3P' => 0,
                 ]);
             }
 
             // Crear la revisión (inicialmente pendiente)
             Revision::create([
                 'id_portafolio' => $portafolio->id_portafolio,
                 'criterio' => 'Pendiente',
                 'resultado' => 'Pendiente',
                 'comentarios' => null,
                 'fecha_revision' => now(),
                 'id_semestre' => $carga->id_semestre,
                 'id_usuario_revisor' => null, // Revisores aún no asignados
             ]);
         }
 
         return response()->json(['message' => 'Portafolios creados con éxito.']);
     }
     public function asignarRevisores()
     {
         try {
             // Obtener las revisiones
             $revisiones = Revision::all();
             
             // Obtener usuarios con los roles de administrador y revisor
             $usuariosRevisores = User::where('es_administrador', 1)
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
     
             return view('admin.asignar_revisores', compact('revisiones', 'usuariosRevisores'));
         } catch (\Exception $e) {
             // Si ocurre algún error, captura la excepción y regresa un mensaje de error
             \Log::error("Error al obtener revisiones o usuarios: " . $e->getMessage());
             return response()->view('errors.500', [], 500); // Vista personalizada de error
         }
     }
     

   // En tu controlador
public function asignarRevisor(Request $request)
{
    // Validar la solicitud
    $validated = $request->validate([
        'revision_id' => 'required|exists:revisiones,id',
        'id_revisor_usuario' => 'required|exists:users,id',
    ]);

    // Lógica para asignar el revisor a la revisión
    $revision = Revision::find($request->revision_id);
    $revision->id_usuario_revisor = $request->id_revisor_usuario;
    $revision->save();

    // Retornar respuesta JSON
    return response()->json([
        'success' => true,
        'message' => 'Revisor asignado con éxito'
    ]);
}





    


}
