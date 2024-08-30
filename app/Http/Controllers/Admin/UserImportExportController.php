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
        return Excel::download(new UsersExport, 'users.csv', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function importUsers() 
    {
        return view('admin.users.import');
    }

    public function importUsersStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx'
        ]);
    
        try {
            Log::info('Iniciando la importación desde el archivo subido');
            $file = $request->file('file');
            
            $import = new UsersImport;
            Excel::import($import, $file);
    
            $duplicatedEmails = $import->getDuplicatedEmails();
    
            if (!empty($duplicatedEmails)) {
                return back()->with('warning', 'Usuarios importados con advertencias: se encontraron correos duplicados')->with('duplicatedEmails', $duplicatedEmails);
            }
    
            Log::info('Importación completada desde el archivo subido: ' . $file->getClientOriginalName());
            return back()->with('success', 'Usuarios importados exitosamente!');
        } catch (\Exception $e) {
            Log::error('Error al importar usuarios desde el archivo subido: ' . $e->getMessage());
            return back()->with('error', 'Hubo un problema al importar los usuarios. Por favor, verifica el archivo y vuelve a intentarlo.');
        }
    }
    
}
