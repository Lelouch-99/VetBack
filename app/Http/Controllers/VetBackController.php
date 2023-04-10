<?php

namespace App\Http\Controllers;

use App\Models\VetBack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VetBackController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        $vetBack = VetBack::create($data);

        $emailData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message']
        ];

        Mail::send('email', $data, function($message) use ($data) {
            $message->to('veterinariapy09@gmail.com');
            $message->subject('Nuevo mensaje de ' . $data['name']);
            $message->from($data['email'], $data['name']);
        });
        

        return response()->json([
            'message' => 'Formulario enviado y almacenado correctamente.',
            'data' => $vetBack
        ]);
    }
}
