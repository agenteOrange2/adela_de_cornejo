<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use App\Models\Post;
use App\Models\SchoolCycle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Asegúrate de importar el modelo User

class StudentAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('students.dashboard', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('students.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|max:1024',
        ]);

        // Actualizar la información del usuario
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;

        // Si hay contraseña, la actualizamos
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Si se ha subido una imagen de perfil, la almacenamos
        if ($request->hasFile('profile_photo')) {
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        // Guardamos los cambios en el usuario
        $user->save();

        return redirect()->route('student.account')->with('status', 'Información actualizada correctamente.');
    }

    public function showCalendarios()
    {
        $user = Auth::user();
        $plantelId = $user->plantel_id;
        $educationLevelId = $user->education_level_id; // Supongamos que el usuario tiene este campo

        // Obtener el ciclo escolar actual desde la tabla school_cycles
        $schoolCycle = SchoolCycle::where('is_current', 1)->first();

        if (!$schoolCycle) {
            return back()->with('error', 'No hay ciclo escolar actual definido.');
        }

        // Obtener los calendarios correspondientes al plantel, nivel educativo y ciclo escolar actual
        $calendarios = Pdf::whereHas('educationLevels', function ($query) use ($educationLevelId, $plantelId, $schoolCycle) {
            $query->where('education_level_id', $educationLevelId)
                ->where('plantel_id', $plantelId)
                ->where('school_cycle_id', $schoolCycle->id);
        })->get();

        // Verificación de los calendarios
        if ($calendarios->isEmpty()) {
            dd('No hay calendarios para este usuario con plantel_id: ' . $plantelId . ', education_level_id: ' . $educationLevelId . ', school_cycle_id: ' . $schoolCycle->id);
        }

        return view('students.calendarios', compact('user', 'calendarios'));
    }


    public function showMenuCafeteria()
    {
        $user = Auth::user();
        $plantelId = $user->plantel_id;

        // Obtener el menú de la cafetería correspondiente al plantel del usuario
        $menuCafeteria = Pdf::whereHas('plantelesForMenu', function ($query) use ($plantelId) {
            $query->where('plantel_id', $plantelId);
        })->get();

        return view('students.menu-cafeteria', compact('user', 'menuCafeteria'));
    }

    public function showAvisos()
    {
        $user = Auth::user();
        $plantelId = $user->plantel_id;

        // Obtener los avisos correspondientes al plantel del usuario
        $avisos = Post::whereHas('planteles', function ($query) use ($plantelId) {
            $query->where('plantel_id', $plantelId);
        })->where('is_published', true)->get();

        return view('students.avisos', compact('user', 'avisos'));
    }

    public function showCalificaciones()
    {
        $user = Auth::user();
        return view('students.calificaciones', compact('user'));
    }

    public function showDatosMedicos()
    {
        $user = Auth::user();    
        return view('students.datos-medicos', compact('user'));
    }
}
