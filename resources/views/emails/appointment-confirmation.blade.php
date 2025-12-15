@component('mail::message')
    # Confirmation de votre rendez-vous

    Bonjour {{ $appointment->client_name }},

    Nous confirmons votre rendez-vous de consultation privée pour le
    **{{ \Carbon\Carbon::parse($appointment->appointment_date)->locale('fr')->isoFormat('LL') }}** à
    **{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}**.

    ## Détails du rendez-vous:
    - Date: {{ \Carbon\Carbon::parse($appointment->appointment_date)->locale('fr')->isoFormat('LL') }}
    - Heure: {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}
    - Durée: 1 heure
    @if ($appointment->consultationType)
        - Type: {{ $appointment->consultationType->name }}
        - Prix: {{ number_format($appointment->consultationType->price, 2) }} €
    @endif

    ## Informations bancaires:
    @if ($bankAccount)
        - Banque: {{ $bankAccount->bank }}
        - Bénéficiaire: {{ $bankAccount->owner }}
        - IBAN: {{ $bankAccount->iban }}
        - BIC/SWIFT: {{ $bankAccount->swift }}
        - Adresse: {{ $bankAccount->address }}
        - Pays: {{ $bankAccount->country }}
    @endif

    ## Méthode de contact:
    @if ($appointment->contact_method === 'email')
        Vous serez contacté(e) par **email** à l'adresse: {{ $appointment->client_email }}
    @elseif($appointment->contact_method === 'whatsapp')
        Vous serez contacté(e) par **WhatsApp** au numéro: {{ $appointment->client_phone }}
    @elseif($appointment->contact_method === 'telephone')
        Vous serez contacté(e) par **téléphone** au numéro: {{ $appointment->client_phone }}
    @else
        Méthode choisie: {{ $appointment->contact_method }}
    @endif

    ## Comment se préparer:
    - Prévoyez un endroit calme et sans distraction pour votre consultation
    - Notez à l'avance les questions qui vous préoccupent le plus
    - Soyez disponible quelques minutes avant l'heure de votre rendez-vous

    Merci pour votre confiance,

    L'équipe d'Auxane Voyance
@endcomponent
