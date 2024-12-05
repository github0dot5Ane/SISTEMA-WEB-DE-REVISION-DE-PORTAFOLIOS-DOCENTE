<?php

namespace App\Exports;

use App\Models\Portafolio;
use App\Models\User;
use App\Models\CargaAcademica;
use App\Models\Curso;
use App\Models\Revision;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PortafoliosExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Obtener los portafolios con los datos necesarios
        return Portafolio::select('id', 'id_usuario', 'id_carga')->get();
    }

    public function headings(): array
    {
        return [
            'Nombre Docente',
            'Curso',
            'Nombre Revisor',
            'Resultado',
            'Comentarios',
            'Fecha de Revisión',
        ];
    }

    public function map($portafolio): array
    {
        // Obtener el nombre del usuario (docente)
        $usuario = User::find($portafolio->id_usuario);
        // Obtener el nombre del curso utilizando el id_carga
        $cargaAcademica = CargaAcademica::find($portafolio->id_carga);
        $curso = $cargaAcademica ? Curso::where('id_curso', $cargaAcademica->id_curso)->first() : null;
        // Obtener la revisión relacionada
        $revision = Revision::where('id_portafolio', $portafolio->id)->first();
        $usuariorevisor = User::find($revision->id_usuario_revisor);

        return [
            // Formateamos los datos para cada columna
            $usuario ? $usuario->name : 'No asignado',
            $curso ? $curso->nombre : 'No asignado',
            $usuariorevisor ? $usuariorevisor->name : 'No asignado',
            $revision ? $revision->resultado : 'No asignado',
            $revision ? $revision->comentarios : 'No asignado',
            $revision && $revision->updated_at ? $revision->updated_at->format('d-m-Y H:i') : 'No disponible',
        ];
    }
}
