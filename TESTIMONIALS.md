# Système de Témoignages Dynamiques

## Fonctionnalités

Le système de témoignages dynamiques permet d'afficher les avis clients directement depuis la base de données avec les fonctionnalités suivantes :

### Champs disponibles
- **name** : Nom du client
- **message** : Contenu du témoignage
- **rating** : Note de 1 à 5 étoiles
- **photo** : Photo du client (optionnelle)
- **is_active** : Statut actif/inactif
- **created_at** : Date de création

### Affichage automatique
- **Photo** : Si une photo est disponible, elle s'affiche; sinon l'initiale du nom est utilisée
- **Rating** : Affichage des étoiles (★★★★★ ou ★★★★☆)
- **Date** : Affichage relatif (il y a 2 jours, il y a 1 mois...)
- **Fallback** : Si aucun témoignage en base, affichage des témoignages statiques

## Interface d'Administration

### Accès
- **URL** : `/admin/testimonials`
- **Route** : `admin.testimonials`
- **Navigation** : Sidebar admin → "Témoignages"

### Fonctionnalités CRUD
- ✅ **Créer** un nouveau témoignage
- ✅ **Lire/Afficher** tous les témoignages avec pagination
- ✅ **Modifier** un témoignage existant
- ✅ **Supprimer** un témoignage
- ✅ **Activer/Désactiver** un témoignage
- ✅ **Recherche** par nom ou message
- ✅ **Upload** de photos
- ✅ **Gestion de la date** de création (personnalisable)

### Interface
- **Responsive** : Desktop et mobile
- **Pagination** : 10 témoignages par page
- **Modal** : Formulaire d'ajout/modification
- **Validation** : Temps réel avec messages d'erreur
- **Upload** : Gestion des images avec aperçu
- **Date personnalisée** : Champ datetime-local avec boutons prédéfinis

## Utilisation

### Via l'Interface Admin
1. Connectez-vous à l'admin
2. Accédez à "Témoignages" dans la sidebar
3. Utilisez les boutons pour créer, modifier, activer/désactiver ou supprimer

### Ajouter un témoignage via Tinker
```php
php artisan tinker

App\Models\Testimonial::create([
    'name' => 'Jean Dupont',
    'message' => 'Excellent service, je recommande !',
    'rating' => 5,
    'is_active' => true
]);
```

### Créer des témoignages avec la Factory
```php
// Créer 10 témoignages aléatoires
App\Models\Testimonial::factory(10)->create();

// Créer un témoignage 5 étoiles avec photo
App\Models\Testimonial::factory()->fiveStars()->withPhoto()->create();
```

### Requêtes utiles
```php
// Récupérer tous les témoignages actifs
$testimonials = App\Models\Testimonial::active()->get();

// Récupérer les témoignages 5 étoiles
$fiveStars = App\Models\Testimonial::byRating(5)->get();

// Récupérer les témoignages récents
$recent = App\Models\Testimonial::active()
    ->orderBy('created_at', 'desc')
    ->take(8)
    ->get();
```

## Gestion des Dates

### Création
- **Date automatique** : Si aucune date n'est spécifiée, utilise la date actuelle
- **Date personnalisée** : Permet de spécifier une date et heure précises
- **Boutons prédéfinis** : Accès rapide aux dates courantes
  - Maintenant
  - Hier
  - Il y a 1 semaine
  - Il y a 1 mois
  - Effacer (utiliser date actuelle)

### Affichage
- **Format relatif** : "il y a 2 jours", "il y a 1 mois"
- **Date exacte** : Visible au survol (tooltip)
- **Format français** : dd/mm/yyyy à hh:mm

### Modification
- Possibilité de modifier la date d'un témoignage existant
- Conservation de la date originale si pas de modification
- Validation automatique du format de date

## Gestion des Photos

### Upload
- **Format** : JPG, PNG, GIF
- **Taille max** : 2MB
- **Stockage** : `storage/app/public/testimonials/`
- **URL publique** : `storage/testimonials/filename.jpg`

### Suppression automatique
- Les anciennes photos sont supprimées lors de la modification
- Les photos sont supprimées lors de la suppression du témoignage

## Permissions

### Accès requis
- **Authentification** : Utilisateur connecté
- **Autorisation** : Middleware 'admin'
- **Route protégée** : `auth` + `admin`

## Structure des fichiers

### Backend
- **Modèle** : `app/Models/Testimonial.php`
- **Migration** : `database/migrations/2025_09_20_050402_create_testimonials_table.php`
- **Seeder** : `database/seeders/TestimonialSeeder.php`
- **Factory** : `database/factories/TestimonialFactory.php`
- **Composant Admin** : `app/Livewire/Admin/Pages/Testimonials.php`

### Frontend
- **Vue Admin** : `resources/views/livewire/admin/pages/testimonials.blade.php`
- **Vue Public** : `resources/views/livewire/pages/home.blade.php`
- **Composant Public** : `app/Livewire/Pages/Home.php`

### Routes
- **Admin** : `GET /admin/testimonials` → `admin.testimonials`
- **Public** : Affichage intégré dans la page d'accueil

## Validation

### Règles
- **name** : Obligatoire, texte, max 255 caractères
- **message** : Obligatoire, texte, max 1000 caractères
- **rating** : Obligatoire, entier entre 1 et 5
- **photo** : Optionnelle, image, max 2MB
- **is_active** : Booléen

### Messages personnalisés
Tous les messages d'erreur sont en français et adaptés au contexte.
