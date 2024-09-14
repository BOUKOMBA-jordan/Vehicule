@extends('base')

@section('title', 'Découvrez notre sélection de véhicules')

@section('content')

<!-- Ajout des styles CSS pour les animations -->
<style>
    /* Couleurs douces et attrayantes */
    :root {
        --primary-background: #e3f2fd; /* Bleu pastel clair */
        --secondary-background: #ffffff; /* Blanc pour les cartes */
        --highlight-color: #0288d1; /* Bleu plus foncé pour les boutons et éléments importants */
        --btn-hover-color: #0277bd; /* Bleu encore plus foncé pour les boutons au survol */
        --text-color: #333; /* Texte en gris foncé */
    }

    body {
        background-color: var(--primary-background);
        color: var(--text-color);
    }

    .search-form {
        transition: all 0.3s ease;
    }
    .search-form:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .vehicle-card {
        transition: all 0.3s ease;
    }
    .vehicle-card:hover {
        transform: scale(1.03);
    }
    .btn-primary {
        transition: all 0.3s ease;
        background-color: var(--highlight-color);
        border: none;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        background-color: var(--btn-hover-color);
    }
    .btn-outline-primary {
        border-color: var(--highlight-color);
        color: var(--highlight-color);
    }
    .btn-outline-primary:hover {
        border-color: var(--btn-hover-color);
        color: var(--btn-hover-color);
    }

    header {
        background-color: var(--highlight-color);
    }

    .bg-light {
        background-color: var(--secondary-background);
    }

    .vehicle-card {
        background-color: var(--secondary-background);
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .vehicle-card:hover {
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
</style>

<!-- En-tête animé -->
<header class="text-white text-center py-5 mb-5" data-aos="fade-down">
    <h1 class="display-4">Découvrez notre collection de véhicules</h1>
    <p class="lead">Trouvez le véhicule de vos rêves parmi notre sélection soigneusement choisie</p>
</header>

<!-- Formulaire de recherche amélioré -->
<div class="bg-light p-5 mb-5" data-aos="fade-up">
    <form action="" method="get" class="container search-form">
        <div class="row g-3">
            <div class="col-12 col-md-3">
                <input type="number" name="mileage" placeholder="Kilométrage maximal" class="form-control" value="{{ $input['mileage'] ?? '' }}" aria-label="Kilométrage maximal">
            </div>
            <div class="col-12 col-md-3">
                <input type="number" name="price" placeholder="Budget max" class="form-control" value="{{ $input['price'] ?? '' }}" aria-label="Budget max">
            </div>
            <div class="col-12 col-md-3">
                <input type="text" name="model" placeholder="Modèle" class="form-control" value="{{ $input['model'] ?? '' }}" aria-label="Modèle">
            </div>
            <div class="col-12 col-md-3">
                <input type="text" name="title" placeholder="Mot clé" class="form-control" value="{{ $input['title'] ?? '' }}" aria-label="Mot clé">
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Rechercher</button>
            </div>
        </div>
    </form>
</div>

<!-- Message d'avertissement -->
@if (isset($noResults) && $noResults)
    <div class="alert alert-warning" role="alert">
        Aucune correspondance trouvée pour votre recherche. Veuillez essayer avec des critères différents.
    </div>
@endif

<!-- Affichage des véhicules avec animations -->
<div class="container">
    <div class="row">
        @forelse ($vehicles as $vehicle)
            <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="vehicle-card">
                    @include('vehicle.card', ['vehicle' => $vehicle])
                </div>
            </div>
        @empty
            <div class="col text-center" data-aos="fade-in">
                <p class="lead">Aucun véhicule ne correspond à votre recherche</p>
                <a href="{{ route('vehicles.index') }}" class="btn btn-outline-primary">Voir tous les véhicules</a>
            </div>
        @endforelse
    </div>
</div>

<!-- Pagination améliorée -->
<div class="container my-4" data-aos="fade-up">
    {{ $vehicles->links() }}
</div>

@endsection

@push('scripts')
<!-- Inclusion de la bibliothèque AOS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            once: true,
        });
    });
</script>
@endpush
