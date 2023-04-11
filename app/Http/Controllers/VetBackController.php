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
                'userMessage' => $data['message']
            ];

            Mail::send('email', $emailData, function($message) use ($emailData) {
                $message->to('veterinariapy09@gmail.com');
                $message->subject('Nuevo mensaje de ' . $emailData['name']);
                $message->from($emailData['email'], $emailData['name']);
            });

            return response()->json([
                'message' => 'Formulario enviado y almacenado correctamente esperando respuesta.',
                'data' => $vetBack
            ]);
    }

    }

