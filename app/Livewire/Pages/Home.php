<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Product;
use App\Models\ConsultationType;
use App\Models\Testimonial;

class Home extends Component
{

    public $products;
    public $consultationTypes;
    public $testimonials;

    // Propriétés du formulaire de témoignage
    public $testimonial_name = '';
    public $testimonial_email = '';
    public $testimonial_message = '';
    public $testimonial_rating = '';
    public $testimonial_honeypot = ''; // Protection anti-spam

    // Protection anti-spam par calcul mathématique
    public $math_number1 = '';
    public $math_number2 = '';
    public $math_operator = '';
    public $math_answer = '';
    public $math_user_answer = '';

    protected $rules = [
        'testimonial_name' => 'required|string|min:2|max:100',
        'testimonial_email' => 'nullable|email|max:255',
        'testimonial_message' => 'required|string|min:10|max:1000',
        'testimonial_rating' => 'required|integer|min:1|max:5',
        'math_user_answer' => 'required',
    ];

    protected $messages = [
        'testimonial_name.required' => 'Le nom est obligatoire.',
        'testimonial_name.min' => 'Le nom doit contenir au moins 2 caractères.',
        'testimonial_name.max' => 'Le nom ne peut pas dépasser 100 caractères.',
        'testimonial_email.email' => 'L\'email doit être une adresse valide.',
        'testimonial_message.required' => 'Le message est obligatoire.',
        'testimonial_message.min' => 'Le message doit contenir au moins 10 caractères.',
        'testimonial_message.max' => 'Le message ne peut pas dépasser 1000 caractères.',
        'testimonial_rating.required' => 'La note est obligatoire.',
        'testimonial_rating.min' => 'La note doit être au minimum de 1.',
        'testimonial_rating.max' => 'La note doit être au maximum de 5.',
        'math_user_answer.required' => 'La réponse au calcul est obligatoire.',
    ];

    public function mount()
    {
        $this->products = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Charger les types de consultation actifs pour les afficher sur la page d'accueil
        $this->consultationTypes = ConsultationType::active()->get();

        // Charger uniquement les témoignages approuvés et actifs pour l'affichage public
        $this->testimonials = Testimonial::active()
            ->approved()
            ->orderBy('created_at', 'desc')
            ->get();

        // Générer un calcul mathématique aléatoire
        $this->generateMathChallenge();
    }

    private function generateMathChallenge()
    {
        // Générer deux nombres aléatoires entre 1 et 5
        $this->math_number1 = rand(1, 5);
        $this->math_number2 = rand(1, 5);

        // Choisir un opérateur aléatoire (+ ou -)
        $operators = ['+', '-'];
        $this->math_operator = $operators[array_rand($operators)];

        // Calculer la réponse correcte
        if ($this->math_operator === '+') {
            $this->math_answer = $this->math_number1 + $this->math_number2;
        } else {
            // Pour éviter les résultats négatifs, s'assurer que le premier nombre est le plus grand
            if ($this->math_number1 < $this->math_number2) {
                $temp = $this->math_number1;
                $this->math_number1 = $this->math_number2;
                $this->math_number2 = $temp;
            }
            $this->math_answer = $this->math_number1 - $this->math_number2;
        }
    }

    public function refreshMathChallenge()
    {
        $this->generateMathChallenge();
        $this->math_user_answer = '';
    }

    public function submitTestimonial()
    {
        // Protection anti-spam : si le champ honeypot est rempli, c'est un bot
        if (!empty($this->testimonial_honeypot)) {
            session()->flash('testimonial_success', 'Merci pour votre témoignage !');
            return;
        }

        $this->validate();

        // Vérifier la réponse au calcul mathématique avec validation stricte
        $userAnswer = trim($this->math_user_answer);

        // Vérifier que c'est bien un nombre valide et le convertir en entier
        if (!is_numeric($userAnswer)) {
            session()->flash('testimonial_error', 'Réponse invalide. Veuillez entrer uniquement le résultat numérique de l\'opération.');
            $this->addError('math_user_answer', 'La réponse doit être un nombre.');
            return;
        }

        $userAnswerInt = (int)$userAnswer;

        // Vérifier que la réponse est exactement correcte
        if ($userAnswerInt !== (int)$this->math_answer) {
            session()->flash('testimonial_error', 'Calcul incorrect. Veuillez résoudre correctement l\'opération mathématique.');
            $this->addError('math_user_answer', 'La réponse au calcul est incorrecte.');
            return;
        }

        try {
            Testimonial::create([
                'name' => $this->testimonial_name,
                'email' => $this->testimonial_email,
                'message' => $this->testimonial_message,
                'rating' => $this->testimonial_rating,
                'status' => 'pending', // En attente d'approbation
                'is_active' => true,
            ]);

            // Reset du formulaire
            $this->testimonial_name = '';
            $this->testimonial_email = '';
            $this->testimonial_message = '';
            $this->testimonial_rating = '';
            $this->testimonial_honeypot = '';
            $this->math_user_answer = '';

            // Générer un nouveau calcul pour le prochain formulaire
            $this->generateMathChallenge();

            session()->flash('testimonial_success',
                'Merci pour votre témoignage ! Il sera publié prochainement.');

        } catch (\Exception $e) {
            session()->flash('testimonial_error',
                'Une erreur est survenue lors de l\'envoi de votre témoignage. Veuillez réessayer.');
        }
    }

    public function getMathQuestionProperty()
    {
        return "{$this->math_number1} {$this->math_operator} {$this->math_number2} = ?";
    }

    public function render()
    {
        return view('livewire.pages.home');
    }
}
