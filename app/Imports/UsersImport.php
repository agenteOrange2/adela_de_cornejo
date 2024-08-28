<?php

namespace App\Imports;


use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Log::info('Procesando fila: ', $row);
    
        // Buscar el usuario por la matrícula o el email
        $user = User::where('matricula', $row[2])->first();
    
        if ($user) {
            Log::info('Actualizando usuario: ' . $user->email);
            // Si el usuario existe, actualizar sus datos
            $user->name = $row[0];
            $user->last_name = $row[1];
            $user->email = $row[3];
            $user->phone = $row[4];
            $user->plantel_id = $row[5];
            $user->education_level_id = $row[6];
            $user->grade_id = $row[7];
            $user->group_id = $row[8];
            $user->save();
    
            Log::info('Usuario actualizado: ' . $user->email);
    
            return $user;
        } else {
            Log::info('Creando nuevo usuario: ' . $row[3]);
            // Si el usuario no existe, crear uno nuevo con una contraseña generada a partir de la matrícula
            $newUser = new User([
                'name' => $row[0],
                'last_name' => $row[1],
                'matricula' => $row[2],
                'email' => $row[3],
                'phone' => $row[4],
                'plantel_id' => $row[5],
                'education_level_id' => $row[6],
                'grade_id' => $row[7],
                'group_id' => $row[8],
                'password' => Hash::make($row[2]), // Contraseña generada a partir de la matrícula                
            ]);
    
            $newUser->assignRole(4);
            Log::info('Usuario creado: ' . $newUser->email);
    
            return $newUser;
        }
    }
    
}
