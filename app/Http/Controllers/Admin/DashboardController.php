<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Event;
use App\Models\User;
use App\Models\Pdf;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAvisos = Post::count();
        $totalEventos = Event::count();
        $totalUsuarios = User::count();      
        $totalCalendariosEscolares = Pdf::where('pdfable_type', 'App\Models\Calendar')->count();  

        return view('admin.dashboard', compact('totalAvisos', 'totalEventos','totalUsuarios' , 'totalCalendariosEscolares'));
    }
}
