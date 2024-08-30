<?php

namespace App\Imports;


use App\Models\User;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Plantel;
use App\Models\EducationLevel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    protected $duplicatedEmails = []; // Almacenar correos duplicados
    protected $processedEmails = []; // Almacenar correos ya procesados para detectar duplicados en el archivo

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Log::info('Procesando fila: ', $row);

        // Extraer la matrícula del correo electrónico
        $matricula = $this->extractMatriculaFromEmail($row['email']);

        // Obtener el identificador del plantel a partir de la primera letra de la matrícula
        $plantelId = $this->getPlantelIdByMatricula($matricula);

        // Verificar si el correo electrónico ya ha sido procesado en este archivo
        if (in_array($row['email'], $this->processedEmails)) {
            $this->duplicatedEmails[] = [
                'email' => $row['email'],
                'name' => $row['nombre'],
                'last_name' => $row['apellido']
            ];
            Log::warning('Correo duplicado encontrado en el archivo: ' . $row['email']);
            return null;
        }

        // Agregar el correo a la lista de procesados
        $this->processedEmails[] = $row['email'];

        // Buscar el usuario por la matrícula o el correo electrónico
        $user = User::where('matricula', $matricula)
                    ->orWhere('email', $row['email'])
                    ->first();

        if ($user) {
            // Verificar si el usuario tiene el rol de estudiante (rol 4)
            if ($user->hasRole(4)) {
                Log::info('Actualizando usuario: ' . $user->email);
                // Si el usuario existe y tiene el rol de estudiante, actualizar sus datos
                $user->name = $row['nombre'];
                $user->last_name = $row['apellido'];
                $user->plantel_id = $plantelId;
                $user->education_level_id = $this->getEducationLevelId($row['nivel_educativo']);
                $user->grade_id = $this->getGradeId($row['grado']);
                $user->group_id = $this->getGroupId($row['grupo']);
                $user->save();

                Log::info('Usuario actualizado: ' . $user->email);
            } else {
                Log::info('Usuario con rol diferente a estudiante, no se actualiza: ' . $user->email);
            }

            return $user;
        } else {
            // Verificar si ya hay un usuario con el mismo correo pero que no es el mismo usuario
            if (User::where('email', $row['email'])->exists()) {
                $this->duplicatedEmails[] = $row['email'];
                Log::warning('Correo duplicado encontrado en la base de datos: ' . $row['email']);
                return null;
            }

            Log::info('Creando nuevo usuario: ' . $row['email']);
            // Si el usuario no existe, crear uno nuevo con una contraseña generada a partir de la matrícula
            $newUser = new User([
                'name' => $row['nombre'],
                'last_name' => $row['apellido'],
                'matricula' => $matricula,
                'email' => $row['email'],
                'plantel_id' => $plantelId,
                'education_level_id' => $this->getEducationLevelId($row['nivel_educativo']),
                'grade_id' => $this->getGradeId($row['grado']),
                'group_id' => $this->getGroupId($row['grupo']),
                'password' => Hash::make($matricula), // Contraseña generada a partir de la matrícula                
            ]);

            $newUser->assignRole(4);
            Log::info('Usuario creado: ' . $newUser->email);

            return $newUser;
        }
    }

    /**
     * Extrae la matrícula del correo electrónico.
     *
     * @param string $email
     * @return string
     */
    protected function extractMatriculaFromEmail($email)
    {
        return substr($email, 0, strpos($email, '@'));
    }

    /**
     * Obtiene el ID del plantel basado en la letra de la matrícula.
     *
     * @param string $matricula
     * @return int|null
     */
    private function getPlantelIdByMatricula($matricula)
    {
        $identifier = substr($matricula, 0, 1); // La primera letra de la matrícula

        return Plantel::where('identifier', $identifier)->first()->id ?? null;
    }

    private function getEducationLevelId($levelName)
    {
        return EducationLevel::where('name', $levelName)->first()->id ?? null;
    }

    private function getGradeId($gradeName)
    {
        return Grade::where('name', $gradeName)->first()->id ?? null;
    }

    private function getGroupId($groupName)
    {
        return Group::where('name', $groupName)->first()->id ?? null;
    }

    /**
     * Obtiene los correos duplicados encontrados durante la importación.
     *
     * @return array
     */
    public function getDuplicatedEmails()
    {
        return $this->duplicatedEmails;
    }
}