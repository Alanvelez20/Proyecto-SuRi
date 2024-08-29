<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validar el formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:500',
        ]);

        // Cambiar 'message' a 'userMessage'
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'userMessage' => $request->message,
        ];

        Mail::send('emails.contact', $data, function($message) use ($data) {
            $message->to('surimx2024@gmail.com')
                    ->subject('Nuevo mensaje de contacto');
        });

        return back()->with('success', 'Tu mensaje ha sido enviado con éxito.');
    }
}
