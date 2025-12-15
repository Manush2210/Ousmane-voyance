<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailTestController extends Controller
{
    public function testEmail()
    {
        try {
            // Afficher les informations de configuration
            $config = [
                'driver' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'username' => config('mail.mailers.smtp.username'),
                'from_address' => config('mail.from.address'),
            ];

            // Essayer d'envoyer un email simple
            Mail::raw('Ceci est un test de l\'envoi d\'email.', function ($message) {
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to('contact@auxane-voyance.com');
                $message->subject('Test d\'envoi d\'email');
            });

            return response()->json([
                'success' => true,
                'message' => 'Email envoyé avec succès',
                'config' => $config
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'config' => $config ?? null,
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
