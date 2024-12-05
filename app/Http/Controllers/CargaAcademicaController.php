<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use App\Http\Requests\StoreCargaAcademicaRequest;
use App\Http\Requests\UpdateCargaAcademicaRequest;

use App\Models\User; // Para obtener IDs de usuarios
use App\Models\CargaAcademica; // Modelo de la tabla carga_academica
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CargaAcademicaController extends Controller
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
    public function store(StoreCargaAcademicaRequest $request)
    {

    }
    public function showUploadForm()
    {
        return view('admin.carga-academica.upload');  // O la vista que contenga el formulario de carga
    }

    /**
     * Display the specified resource.
     */
    public function show(CargaAcademica $cargaAcademica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CargaAcademica $cargaAcademica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCargaAcademicaRequest $request, CargaAcademica $cargaAcademica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CargaAcademica $cargaAcademica)
    {
        //
    }
    // Mostrar el formulario de carga académica
    public function form()
    {
        // Devuelve la vista con el formulario de carga académica
        return view('admin.carga-academica.form');
    }

    public function upload(Request $request)
{
    try {
        $request->validate([
            'carga_academica' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('carga_academica');
        $data = \Maatwebsite\Excel\Facades\Excel::toArray([], $file);
        $hoja = array_slice($data[0], 1); // Omitir encabezados
        $usuarios = User::pluck('id', 'name')->toArray(); // Obtener IDs de usuarios por nombre

        $errores = []; // Registrar errores por fila

        foreach ($hoja as $index => $fila) {
            try {
                // Validar si la fila tiene al menos las columnas necesarias
                if (count($fila) < 17) { // Ajusta este número si el archivo tiene más o menos columnas
                    $errores[] = "Fila {$index}: Faltan columnas necesarias.";
                    continue;
                }
        
                // Extraer datos de la fila
                $idCurso = trim($fila[2]); // Columna C: id_curso
                $nombreUsuario = trim($fila[16]); // Columna Q: Usuario
                $nroCreditos = trim($fila[5]); // Columna F: Número de créditos
                $esTeoricoTexto = strtolower(trim($fila[6])); // Columna G: T o P
        
                // Validar contenido básico
                if (empty($idCurso) || empty($nombreUsuario) || !is_numeric($nroCreditos)) {
                    $errores[] = "Fila {$index}: Datos inválidos (curso, usuario o créditos).";
                    continue;
                }
        
                // Convertir el valor teórico a booleano
                $esTeorico = ($esTeoricoTexto === 't') ? 1 : 0;
        
                // Buscar usuario por nombre en la tabla users
                if (!isset($usuarios[$nombreUsuario])) {
                    $errores[] = "Fila {$index}: Usuario '{$nombreUsuario}' no encontrado.";
                    continue;
                }
        
                $idUsuario = $usuarios[$nombreUsuario];
        
                // Verificar duplicados en la base de datos
                $existe = CargaAcademica::where('id_curso', $idCurso)
                    ->where('id_usuario', $idUsuario)
                    ->where('es_teorico', $esTeorico)
                    ->exists();
        
                if (!$existe) {
                    // Agregar fila válida a la base de datos
                    CargaAcademica::create([
                        'id_curso' => $idCurso,
                        'id_usuario' => $idUsuario,
                        'nro_creditos' => (int)$nroCreditos,
                        'es_teorico' => $esTeorico,
                        'id_malla' => 1,
                        'id_semestre' => 1,
                    ]);
                } else {
                    $errores[] = "Fila {$index}: Registro duplicado.";
                }
            } catch (\Exception $e) {
                $errores[] = "Fila {$index}: " . $e->getMessage();
            }
        }
        
        

        $tabla = CargaAcademica::all();

        return response()->json([
            'status' => 'success',
            'html' => view('admin.carga-academica.table', compact('tabla'))->render(),
            'errores' => $errores,
        ]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
}



}
