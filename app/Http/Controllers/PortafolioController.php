<?php

namespace App\Http\Controllers;

use App\Models\Portafolio;
use App\Http\Requests\StorePortafolioRequest;
use App\Http\Requests\UpdatePortafolioRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\CargaAcademica;
use App\Models\Revision;
use App\Models\ItemsTeorico;
use App\Models\ItemsPractico;



class PortafolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

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
    public function store(StorePortafolioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Portafolio $portafolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portafolio $portafolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortafolioRequest $request, Portafolio $portafolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portafolio $portafolio)
    {
        //
    }
    public function mostrarFormulario()
    {
        return view('admin.crear_portafolios');
    }


    public function crearPortafolio(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'id_usuario' => 'required|exists:users,id',
            'id_carga' => 'required|exists:carga_academica,id',
            'fecha_subida' => 'required|date',
            'estado' => 'required|in:Pendiente,Revisado,Corregir',
            'id_semestre' => 'required|exists:semestre,id',
            'caratula' => 'boolean',
            'carga_lectiva' => 'boolean',
            'filosofia' => 'boolean',
            'cv' => 'boolean',
            'silabo' => 'boolean',
            'tipo_curso' => 'required|boolean',
        ]);

        try {
            // Crear el nuevo portafolio
            $portafolio = new Portafolio();
            $portafolio->id_usuario = $request->input('id_usuario');
            $portafolio->id_carga = $request->input('id_carga');
            $portafolio->fecha_subida = $request->input('fecha_subida');
            $portafolio->estado = $request->input('estado');
            $portafolio->id_semestre = $request->input('id_semestre');
            $portafolio->caratula = $request->input('caratula', false);
            $portafolio->carga_lectiva = $request->input('carga_lectiva', false);
            $portafolio->filosofia = $request->input('filosofia', false);
            $portafolio->cv = $request->input('cv', false);
            $portafolio->silabo = $request->input('silabo', false);
            $portafolio->tipo_curso = $request->input('tipo_curso');

            // Guardar el portafolio
            $portafolio->save();

            // Respuesta exitosa
            return response()->json([
                'success' => true,
                'message' => 'Portafolio creado exitosamente',
                'data' => $portafolio,
            ], 200);

        } catch (\Exception $e) {
            // Registrar el error en los logs
            Log::error('Error al crear portafolio: ' . $e->getMessage());

            // Respuesta de error
            return response()->json([
                'success' => false,
                'message' => 'Hubo un problema al crear el portafolio',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function editarDetallesGenerales($id)
{
    // Recuperar el portafolio por ID
    $portafolio = Portafolio::find($id);
    // Devolver a la vista con los datos del portafolio
    return view('revisor.editar_detalles', compact('portafolio'));
}
public function guardarDetallesGenerales(Request $request, $id)
{
    // Encuentra el portafolio por su ID
    $portafolio = Portafolio::find($id);

    if (!$portafolio) {
        return redirect()->back()->with('error', 'Portafolio no encontrado.');
    }

    // Valida los datos del formulario
    $request->validate([
        'caratula' => 'required|boolean',
        'carga_lectiva' => 'required|boolean',
        'filosofia' => 'required|boolean',
        'cv' => 'required|boolean',
        'silabo' => 'required|boolean',
    ]);

    // Actualiza los detalles generales
    $portafolio->caratula = $request->caratula;
    $portafolio->carga_lectiva = $request->carga_lectiva;
    $portafolio->filosofia = $request->filosofia;
    $portafolio->cv = $request->cv;
    $portafolio->silabo = $request->silabo;
    // Verifica si todos los checkboxes están marcados
    

    
    

    // Guarda los cambios
    $portafolio->save();

    // Redirige con un mensaje de éxito
    return redirect()->route('revisor.dashboard')->with('success', 'Detalles generales actualizados.');
}



public function editarItemsTeorico($id)
{
    // Recuperar el portafolio por ID
    $portafolio = Portafolio::find($id);
    // Recuperar los items correspondientes de la tabla items_teorico
    $itemsTeorico = ItemsTeorico::where('id_portafolio', $id)->first();
    return view('revisor.editar_items_teorico', compact('portafolio', 'itemsTeorico'));
}
public function guardarItemsTeorico(Request $request, $id)
{
    // Encuentra los ítems teóricos buscando por id_portafolio
    $itemsTeorico = ItemsTeorico::where('id_portafolio', $id)->first();

    if (!$itemsTeorico) {
        return redirect()->back()->with('error', 'Ítems teóricos no encontrados para el portafolio especificado.');
    }

    // Validar los datos del formulario
    $request->validate([
        'avance_academico' => 'required|boolean',
        'registro_entrega_silabo' => 'required|boolean',
        'informe_examen_entrada' => 'required|boolean',
        'enunciado_y_solucion_exameN_1P' => 'required|boolean',
        'enunciado_y_solucion_exameN_2P' => 'required|boolean',
        'enunciado_y_solucion_exameN_3P' => 'required|boolean',
        'evidencia_actividades' => 'required|boolean',
        'registro_asistencia_1P' => 'required|boolean',
        'registro_asistencia_2P' => 'required|boolean',
        'registro_asistencia_3P' => 'required|boolean',
        'registro_notas_1P' => 'required|boolean',
        'registro_notas_2P' => 'required|boolean',
        'registro_notas_3P' => 'required|boolean',
        'cierre_portafolio' => 'required|boolean',
    ]);

    // Lista de campos a actualizar
    $campos = [
        'avance_academico',
        'registro_entrega_silabo',
        'informe_examen_entrada',
        'enunciado_y_solucion_exameN_1P',
        'enunciado_y_solucion_exameN_2P',
        'enunciado_y_solucion_exameN_3P',
        'evidencia_actividades',
        'registro_asistencia_1P',
        'registro_asistencia_2P',
        'registro_asistencia_3P',
        'registro_notas_1P',
        'registro_notas_2P',
        'registro_notas_3P',
        'cierre_portafolio',
    ];

    // Actualizar los campos de itemsTeorico
    foreach ($campos as $campo) {
        if ($request->has($campo)) {
            $itemsTeorico->$campo = $request->$campo;
        }
    }

    // Verifica si todos los checkboxes están marcados
    $todosMarcados = true;
    foreach ($campos as $campo) {
        if (!$request->has($campo) || !$request->$campo) {
            $todosMarcados = false;
            break;
        }
    }

    // Verificar si los valores en la tabla 'portafolio' son '1' para los campos especificados
    $portafolio = Portafolio::find($id);
    $revision = Revision::where('id_portafolio', $id)->first();

    if ($portafolio && $portafolio->caratula == 1 && $portafolio->carga_lectiva == 1 && $portafolio->filosofia == 1 && $portafolio->cv == 1 && $portafolio->silabo == 1) {
        // Si los valores de 'portafolio' son 1 y todos los checkboxes están marcados
        if ($todosMarcados) {
            // Actualizar el estado a 'Revisado' para ItemsTeorico y Portafolio
            $revision->resultado = 'Aprobado';
            $portafolio->estado = 'Revisado';  // Actualizamos el estado del portafolio
        } else {
            // Si algún checkbox no está marcado, actualizar el estado a 'Corregir'
            $revision->resultado = 'Corregir';
            $portafolio->estado = 'Corregir';  // Actualizamos el estado del portafolio
        }
    } else {
        // Si alguno de los valores de 'portafolio' no es 1, poner estado 'Corregir'
        $revision->resultado = 'Corregir';
        $portafolio->estado = 'Corregir';  // Actualizamos el estado del portafolio
    }

    // Guardar los cambios en ambos modelos
    $itemsTeorico->save();
    $portafolio->save();
    $revision->save();

    // Redirige con un mensaje de éxito
    return redirect()->route('revisor.dashboard', $id)->with('success', 'Ítems teóricos actualizados correctamente.');
}





public function editarItemsPractico($id)
{
    // Recuperar el portafolio por ID
    $portafolio = Portafolio::find($id);
    // Recuperar los items correspondientes de la tabla items_practico
    $itemsPractico = ItemsPractico::where('id_portafolio', $id)->first();
    return view('revisor.editar_items_practico', compact('portafolio', 'itemsPractico'));
}
public function guardarItemsPractico(Request $request, $portafolioId)
{
    $itemsPractico = ItemsPractico::where('id_portafolio', $portafolioId)->first();
    
    if (!$itemsPractico) {
        return redirect()->back()->with('error', 'Ítems prácticos no encontrados para el portafolio especificado.');
    }

    $validated = $request->validate([
        'avance_academico' => 'required|boolean',
        'evidencia_actividades' => 'required|boolean',
        'registro_asistencia_1P' => 'required|boolean',
        'registro_asistencia_2P' => 'required|boolean',
        'registro_asistencia_3P' => 'required|boolean',
        'registro_notas_1P' => 'required|boolean',
        'registro_notas_2P' => 'required|boolean',
        'registro_notas_3P' => 'required|boolean',
    ]);

    $campos = [
        'avance_academico',
        'evidencia_actividades',
        'registro_asistencia_1P',
        'registro_asistencia_2P',
        'registro_asistencia_3P',
        'registro_notas_1P',
        'registro_notas_2P',
        'registro_notas_3P',
    ];

    foreach ($campos as $campo) {
        $itemsPractico->$campo = $request->$campo;
    }

    $todosMarcados = collect($campos)->every(fn($campo) => $request->boolean($campo));

    $portafolio = Portafolio::find($portafolioId);
    $revision = Revision::where('id_portafolio', $portafolioId)->first();

    $camposPortafolio = ['caratula', 'carga_lectiva', 'filosofia', 'cv', 'silabo'];
    $estadoCompleto = $portafolio && collect($camposPortafolio)->every(fn($campo) => $portafolio->$campo == 1);

    if ($estadoCompleto && $todosMarcados) {
        if ($revision) {
            $revision->resultado = 'Aprobado';
            $revision->save();
        }
        $portafolio->estado = 'Revisado';
    } else {
        if ($revision) {
            $revision->resultado = 'Corregir';
            $revision->save();
        }
        $portafolio->estado = 'Corregir';
    }

    $itemsPractico->save();
    $portafolio->save();

    return redirect()->route('revisor.dashboard', $portafolioId)
        ->with('success', 'Ítems prácticos actualizados correctamente.');
}




}
