<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use App\Models\Post;
use App\Models\SchoolCycle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|max:1024',
        ]);

        // Actualizar la información del usuario
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_photo')) {
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->save();

        return redirect()->route('student.account')->with('status', 'Información actualizada correctamente.');
    }

    public function showCalendarios()
    {
        $user = Auth::user();
        $plantelId = $user->plantel_id;

        // Obtener los calendarios correspondientes al plantel del usuario
        $calendarios = Pdf::whereHas('planteles', function ($query) use ($plantelId) {
            $query->where('plantel_id', $plantelId);
        })->whereHasMorph('pdfable', [SchoolCycle::class])->get();

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
}
