@extends('base')
@section('title', 'Accueil')

@section('content')

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    :root {
        --background-gradient-start: #e3f2fd; /* Bleu pastel clair */
        --background-gradient-end: #bbdefb; /* Bleu légèrement plus foncé */
        --text-color: #333; /* Gris foncé pour le texte */
        --highlight-color: #ffeb3b; /* Jaune clair pour les éléments de mise en valeur */
        --card-background: #ffffff; /* Blanc pour les cartes */
        --card-shadow: rgba(0, 0, 0, 0.1); /* Ombre légère pour les cartes */
        --card-hover-shadow: rgba(0, 0, 0, 0.2); /* Ombre plus marquée au survol */
    }

    body {
        background: linear-gradient(135deg, var(--background-gradient-start), var(--background-gradient-end));
        color: var(--text-color);
        margin: 0;
        padding: 0;
    }

    .bg-custom {
        background: rgba(255, 255, 255, 0.8); /* Couleur de fond semi-transparente pour le conteneur */
        color: var(--text-color);
        border-radius: 15px;
        padding: 3rem;
        text-align: center;
        box-shadow: 0 10px 30px var(--card-shadow);
        animation: fadeInUp 0.8s ease-out;
    }

    .bg-custom h1 {
        font-size: 3.5rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .bg-custom p {
        font-size: 1.3rem;
        line-height: 1.6;
        max-width: 800px;
        margin: 0 auto;
    }

    .bg-custom p::before {
        content: "";
        display: block;
        height: 3px;
        width: 100px;
        background-color: var(--highlight-color);
        margin: 0 auto 1.5rem;
        transition: width 0.5s ease;
    }

    .bg-custom:hover p::before {
        width: 150px;
    }

    .vehicle-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
        background-color: var(--card-background);
        box-shadow: 0 4px 8px var(--card-shadow);
    }

    .vehicle-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px var(--card-hover-shadow);
    }

    .section-title {
        position: relative;
        display: inline-block;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 2rem;
        color: var(--text-color);
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: var(--highlight-color);
        transition: width 0.3s ease;
    }

    .section-title:hover::after {
        width: 100%;
    }

    @media (max-width: 991.98px) {
        .bg-custom {
            padding: 2rem;
        }
        .bg-custom h1 {
            font-size: 2.5rem;
        }
        .bg-custom p {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 767.98px) {
        .bg-custom {
            padding: 1.5rem;
        }
        .bg-custom h1 {
            font-size: 2rem;
        }
        .bg-custom p {
            font-size: 1.1rem;
        }
        .section-title {
            font-size: 2rem;
        }
    }
</style>

<div class="bg-custom mb-5 mt-5">
    <div class="container">
        <h1 class="mb-4">UniversAuto</h1>
        <p class="lead mb-4">
            Bienvenue chez UniversAuto, où nous transformons votre expérience automobile.
            Que vous recherchiez le véhicule parfait à acheter ou à louer, nous sommes déterminés
            à rendre votre parcours aussi fluide et agréable que possible. Pour les vendeurs,
            notre mission est de vous connecter efficacement avec des acheteurs potentiels,
            ouvrant ainsi de nouvelles perspectives pour votre véhicule.
        </p>
    </div>
</div>

<div class="container">
    <h2 class="section-title">Nos derniers véhicules</h2>
    <div class="row">
        @foreach ($vehicles as $index => $vehicle)
        <div class="col-md-4 mb-4">
            <div class="vehicle-card" style="animation-delay: {{ $index * 0.1 }}s;">
                @include('vehicle.card')
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
