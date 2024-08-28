<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithStyles, WithColumnFormatting
{
    use exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return User::with(['plantel', 'educationLevel', 'grade', 'group'])->get();
    }    

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Apellido',
            'Matricula',
            'Email',
            'Telefono',            
            'Plantel',
            'Nivel Educativo',
            'Grado',
            'Grupo',            
            'Actualizado en',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->last_name,
            $user->matricula,
            $user->email,
            $user->phone,            
            $user->plantel->name ?? 'N/A', // Mostrar el nombre del plantel en lugar del ID
            $user->educationLevel->name ?? 'N/A', // Mostrar el nombre del nivel educativo
            $user->grade->name ?? 'N/A', // Mostrar el nombre del grado
            $user->group->name ?? 'N/A', // Mostrar el nombre del grupo            
            Date::dateTimeToExcel($user->updated_at),
        ];
    }

    public function startCell(): string
    {
        return 'A2'; // Comienza a exportar datos desde la celda A1
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para la primera fila (nombres de columnas)
            1 => ['font' => ['bold' => true]],
        ];
    }
    
    public function columnFormats(): array
    {
        return [            
            'K' => 'dd/mm/yyyy',
        ];
    }

}
