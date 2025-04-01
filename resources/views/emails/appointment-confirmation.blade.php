@component('mail::message')
# Confirmation de votre rendez-vous

Bonjour {{ $appointment->client_name }},

Nous confirmons votre rendez-vous de consultation privée pour le **{{ \Carbon\Carbon::parse($appointment->appointment_date)->locale('fr')->isoFormat('LL') }}** à **{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}**.

## Détails du rendez-vous:
- Date: {{ \Carbon\Carbon::parse($appointment->appointment_date)->locale('fr')->isoFormat('LL') }}
- Heure: {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}
- Durée: 1 heure
- Moyen: Téléphone

@if($appointment->contact_method === 'email')
Vous recevrez un email à l'adresse que vous avez fournie: {{ $appointment->client_email }}.
@elseif($appointment->contact_method === 'whatsapp')
Vous recevrez un message WhatsApp au numéro que vous avez fourni: {{ $appointment->client_phone }}.
@endif

Merci pour votre confiance,

Voyance et  Bienveillance
@endcomponent
