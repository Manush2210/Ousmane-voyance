<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation de votre rendez-vous</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background:#f7fafc; color:#374151; margin:0; padding:0 }
        .container { max-width:680px; margin:24px auto; background:white; border-radius:8px; overflow:hidden; box-shadow:0 8px 30px rgba(16,24,40,.08) }
        .header { background:linear-gradient(90deg,#4f46e5,#7c3aed); padding:28px; color:white }
        .logo { font-weight:700; font-size:20px }
        .content { padding:28px }
        h1 { margin:0 0 12px; font-size:20px; color:#111827 }
        p { margin:0 0 12px; line-height:1.6 }
        .meta { background:#f3f4f6; padding:12px; border-radius:6px; margin:12px 0 }
        .btn { display:inline-block; background:#4f46e5; color:white; padding:10px 16px; border-radius:8px; text-decoration:none }
        .footer { font-size:13px; color:#6b7280; padding:18px; text-align:center }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Voyance Spirituelle Expert</div>
        </div>
        <div class="content">
            <h1>Votre rendez-vous est confirmé</h1>

            <p>Bonjour <strong>{{ $appointment->client_name }}</strong>,</p>

            <p>Merci pour votre réservation. Voici le récapitulatif de votre rendez-vous :</p>

            <div class="meta">
                <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->locale('fr')->isoFormat('LL') }}</p>
                <p><strong>Heure :</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($appointment->end_time)->format('H:i') }}</p>
                @if ($appointment->consultationType)
                    <p><strong>Type :</strong> {{ $appointment->consultationType->name }} — {{ number_format($appointment->consultationType->price, 2) }} €</p>
                @endif
                <p><strong>Méthode de contact :</strong>
                    @if ($appointment->contact_method === 'email')
                        Email ({{ $appointment->client_email }})
                    @elseif($appointment->contact_method === 'whatsapp')
                        WhatsApp ({{ $appointment->client_phone }})
                    @else
                        Téléphone ({{ $appointment->client_phone }})
                    @endif
                </p>
            </div>

            @if ($appointment->notes)
                <p><strong>Notes envoyées :</strong></p>
                <p>{{ $appointment->notes }}</p>
            @endif

            <p>Si vous avez des questions ou souhaitez modifier votre rendez-vous, vous pouvez répondre directement à ce message.</p>

            <p style="margin-top:18px">
                <a class="btn" href="{{ url('/') }}">Visiter le site</a>
            </p>

            <p style="margin-top:18px; color:#6b7280; font-size:13px">Merci pour votre confiance,<br>Voyance Spirituelle Expert</p>
        </div>
        <div class="footer">Si vous n'êtes pas à l'origine de cette réservation, contactez-nous immédiatement à contact@auxane-voyance.com</div>
    </div>
</body>
</html>
