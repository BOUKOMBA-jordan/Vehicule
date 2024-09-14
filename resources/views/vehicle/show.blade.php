@extends('base')

<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

@section('title', $vehicle->make . ' ' . $vehicle->model)

@section('content')

<style>
    .hero-section {
        background-color: #f8f9fa;
        padding: 3rem 0;
        margin-bottom: 2rem;
    }
    .carousel-item img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
    }
    .vehicle-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
    }
    .vehicle-subtitle {
        font-size: 1.2rem;
        color: #6c757d;
    }
    .vehicle-price {
        font-size: 2rem;
        font-weight: 700;
        color: #28a745;
    }
    .details-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    .contact-section {
        background-color: #e9ecef;
        padding: 3rem 0;
        border-radius: 8px;
    }
    .contact-btn {
        font-size: 1.1rem;
        padding: 0.75rem 1.5rem;
    }
    .features-list {
        columns: 2;
        column-gap: 2rem;
    }
    .features-list li {
        margin-bottom: 0.5rem;
    }
    /* Styles pour le formulaire dans le modal */
    .modal-body form {
        display: flex;
        flex-direction: column;
    }
    .modal-body .form-group {
        margin-bottom: 1rem;
    }
    .modal-body label {
        font-weight: bold;
    }
    .modal-body input, .modal-body textarea {
        border-radius: 4px;
        border: 1px solid #ced4da;
        padding: 0.5rem;
        width: 100%;
    }
    .modal-body textarea {
        resize: vertical;
    }
    .modal-body button {
        font-size: 1.1rem;
        padding: 0.75rem 1.5rem;
    }
</style>

<div class="hero-section">
    <div class="container">
        <h1 class="vehicle-title">{{ $vehicle->make }} {{ $vehicle->model }}</h1>
        <p class="vehicle-subtitle">{{ $vehicle->year }} - {{ number_format($vehicle->mileage, 0, ',', ' ') }} km</p>
        <div class="vehicle-price mb-3">{{ number_format($vehicle->price, 0, ',', ' ') }} Fcfa</div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div id="vehicleCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($vehicle->images as $image)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <img src="{{ asset($image->image) }}" class="d-block" alt="Image {{ $loop->index + 1 }} de {{ $vehicle->make }} {{ $vehicle->model }}">
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#vehicleCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Précédent</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#vehicleCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Suivant</span>
                </button>
            </div>

            <div class="details-card">
                <h2 class="mb-3">Caractéristiques</h2>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled features-list">
                            <li><strong>Marque:</strong> {{ $vehicle->make }}</li>
                            <li><strong>Modèle:</strong> {{ $vehicle->model }}</li>
                            <li><strong>Année:</strong> {{ $vehicle->year }}</li>
                            <li><strong>Référence:</strong> {{ $vehicle->reference }}</li>

                            <li><strong>Kilométrage:</strong> {{ number_format($vehicle->mileage, 0, ',', ' ') }} km</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled features-list">
                            <li><strong>Carburant:</strong> {{ $vehicle->fuel_type }}</li>
                            <li><strong>Couleur:</strong> {{ $vehicle->color }}</li>
                            <li><strong>Localisation:</strong> {{ $vehicle->city }} ({{ $vehicle->postal_code }})</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="details-card">
                <h2 class="mb-3">Spécificités</h2>
                <ul class="list-unstyled features-list">
                    @foreach ($vehicle->options as $option)
                    <li><i class="fas fa-check-circle text-success me-2"></i>{{ $option->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="details-card">
                <h2 class="mb-3">Contact</h2>
                <p>Pour plus d'informations, contactez-nous :</p>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="tel:+241076218187" class="text-decoration-none">
                            <i class="fas fa-phone-alt me-2 text-primary"></i>+241 076 218 187
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/06218187" target="_blank" class="text-decoration-none">
                            <i class="fab fa-whatsapp me-2 text-success"></i>Contactez-nous sur WhatsApp
                        </a>
                    </li>
                </ul>
                <button type="button" class="btn btn-primary btn-lg w-100 mt-3 contact-btn" data-bs-toggle="modal" data-bs-target="#contactModal">
                    Intéressé ? Envoyez un message
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contactez-nous</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('vehicle.contact', $vehicle) }}" method="post" class="vstack gap-3">
                    @csrf

                    <div class="row">
                        @include('shared.input', ['class' => 'col-md-6', 'name' => 'firstname', 'label' => 'Prénom'])
                        @include('shared.input', ['class' => 'col-md-6', 'name' => 'lastname', 'label' => 'Nom'])
                    </div>

                    <div class="row">
                        @include('shared.input', ['class' => 'col-md-6', 'name' => 'phone', 'label' => 'Téléphone'])
                        @include('shared.input', ['type' => 'email', 'class' => 'col-md-6', 'name' => 'email', 'label' => 'Email'])
                    </div>

                    @include('shared.input', ['type' => 'textarea', 'class' => 'col-12', 'name' => 'message', 'label' => 'Votre message'])

                    <div>
                        <button class="btn btn-primary">Nous contacter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
