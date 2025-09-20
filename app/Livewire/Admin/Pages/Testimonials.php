<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Testimonial;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.admin-app')]
class Testimonials extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $editingTestimonial = null;

    // Propriétés du formulaire
    public $name = '';
    public $message = '';
    public $rating = 5;
    public $photo;
    public $existing_photo = '';
    public $is_active = true;
    public $created_at = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'message' => 'required|string|max:1000',
        'rating' => 'required|integer|min:1|max:5',
        'photo' => 'nullable|image|max:2048', // 2MB Max
        'is_active' => 'boolean',
        'created_at' => 'nullable|date'
    ];

    protected $messages = [
        'name.required' => 'Le nom est obligatoire.',
        'message.required' => 'Le message est obligatoire.',
        'message.max' => 'Le message ne peut pas dépasser 1000 caractères.',
        'rating.required' => 'La note est obligatoire.',
        'rating.min' => 'La note doit être au minimum de 1.',
        'rating.max' => 'La note doit être au maximum de 5.',
        'photo.image' => 'Le fichier doit être une image.',
        'photo.max' => 'L\'image ne peut pas dépasser 2MB.',
        'created_at.date' => 'La date doit être une date valide.'
    ];

    public function render()
    {
        $testimonials = Testimonial::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('message', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.pages.testimonials', compact('testimonials'));
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->editingTestimonial = null;
        $this->name = '';
        $this->message = '';
        $this->rating = 5;
        $this->photo = null;
        $this->existing_photo = '';
        $this->is_active = true;
        $this->created_at = '';
    }

    public function save()
    {
        $this->validate();

        $testimonialData = [
            'name' => $this->name,
            'message' => $this->message,
            'rating' => $this->rating,
            'is_active' => $this->is_active,
        ];

        // Gestion de la date de création
        if ($this->created_at) {
            $testimonialData['created_at'] = $this->created_at;
        }

        // Gestion de l'upload de photo
        if ($this->photo) {
            $photoPath = $this->photo->store('testimonials', 'public');
            $testimonialData['photo'] = $photoPath;

            // Supprimer l'ancienne photo si c'est une modification
            if ($this->editingTestimonial && $this->existing_photo) {
                Storage::disk('public')->delete($this->existing_photo);
            }
        }

        if ($this->editingTestimonial) {
            $this->editingTestimonial->update($testimonialData);
            session()->flash('message', 'Témoignage mis à jour avec succès.');
        } else {
            Testimonial::create($testimonialData);
            session()->flash('message', 'Témoignage créé avec succès.');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $this->editingTestimonial = Testimonial::findOrFail($id);

        $this->name = $this->editingTestimonial->name;
        $this->message = $this->editingTestimonial->message;
        $this->rating = $this->editingTestimonial->rating;
        $this->existing_photo = $this->editingTestimonial->photo;
        $this->is_active = $this->editingTestimonial->is_active;
        $this->created_at = $this->editingTestimonial->created_at->format('Y-m-d\TH:i');

        $this->showModal = true;
    }

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Supprimer la photo si elle existe
        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();
        session()->flash('message', 'Témoignage supprimé avec succès.');
    }

    public function toggleStatus($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_active' => !$testimonial->is_active]);

        $status = $testimonial->is_active ? 'activé' : 'désactivé';
        session()->flash('message', "Témoignage {$status} avec succès.");
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setCreatedAtToNow()
    {
        $this->created_at = now()->format('Y-m-d\TH:i');
    }

    public function setCreatedAtToYesterday()
    {
        $this->created_at = now()->subDay()->format('Y-m-d\TH:i');
    }

    public function setCreatedAtToLastWeek()
    {
        $this->created_at = now()->subWeek()->format('Y-m-d\TH:i');
    }

    public function setCreatedAtToLastMonth()
    {
        $this->created_at = now()->subMonth()->format('Y-m-d\TH:i');
    }
}
