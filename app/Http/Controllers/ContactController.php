<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contacto.index');
    }

    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'asunto' => 'required',
            'message' => 'required',
        ]);
    
        Mail::to('frontend@kuiraweb.com')->send(new ContactMailable($request->all()));
    
        
        return back()->with('success', '¡Gracias por contactarnos! Te responderemos lo antes posible.');
    
    }
}
