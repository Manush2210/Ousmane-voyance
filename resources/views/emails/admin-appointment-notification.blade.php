@component('mail::message')
# Nouvelle réservation de consultation

Une nouvelle réservation a été effectuée.

## Détails du client:
- Nom: {{ $appointment->client_name }}
- Email: {{ $appointment->client_email }}
- Téléphone: {{ $appointment->client_phone }}

## Détails du rendez-vous:
- Date: {{ \Carbon\Carbon::parse($appointment->appointment_date)->locale('fr')->isoFormat('LL') }}
- Heure: {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}

## Méthode de contact:
- {{ $appointment->contact_method }}

@if($appointment->notes)
## Notes du client:
{{ $appointment->notes }}
@endif

La preuve de paiement est jointe à cet email.

@component('mail::button', ['url' => url('/admin/appointments/'.$appointment->id)])
Voir le rendez-vous
@endcomponent

@endcomponent
