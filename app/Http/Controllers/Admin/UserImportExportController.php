<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UserImportExportController extends Controller
{
    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function importUsers() 
    {
        try {
            Log::info('Iniciando la importación desde el archivo "users.xlsx"');
            Excel::import(new UsersImport, 'users.xlsx');
            Log::info('Importación completada desde el archivo "users.xlsx"');
            
            return redirect()->route('admin.users.index')->with('success', 'All good!');
        } catch (\Exception $e) {
            Log::error('Error al importar usuarios desde "users.xlsx": ' . $e->getMessage());
            return redirect()->route('admin.users.index')->with('error', 'Hubo un problema al importar los usuarios.');
        }
    }

    public function importUsersStore(Request $request)
    {
        // Depurar para ver si el archivo está siendo recibido correctamente
        //dd($request->all()); // Verifica si los datos del formulario están llegando correctamente
    
        $request->validate([
            'file' => 'required|mimes:xlsx,txt'
        ]);
    
        try {
            Log::info('Iniciando la importación desde el archivo subido');
            $file = $request->file('file');
            
            // Depurar para ver el nombre y el path del archivo subido
            dd($file->getClientOriginalName(), $file->getRealPath()); // Verifica que el archivo esté correctamente subido
    
            Excel::import(new UsersImport, $file);
    
            Log::info('Importación completada desde el archivo subido: ' . $file->getClientOriginalName());
            return back()->with('success', 'Usuarios importados exitosamente!');
        } catch (\Exception $e) {
            Log::error('Error al importar usuarios desde el archivo subido: ' . $e->getMessage());
            return back()->with('error', 'Hubo un problema al importar los usuarios. Por favor, verifica el archivo y vuelve a intentarlo.');
        }
    }
    
}
