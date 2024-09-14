<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/favicon.svg" href="favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>@yield('title') | UniversAuto</title>

    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #0066cc;
            --accent-color: #ffcc00;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand svg {
            width: 180px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover svg {
            transform: scale(1.05);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .login-btn {
            background-color: var(--accent-color);
            color: var(--primary-color);
            border: none;
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background-color: #ffffff;
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 991.98px) {
            .navbar-brand svg {
                width: 150px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a href="/" class="navbar-brand">
                <svg viewBox="0 0 600 150" xmlns="http://www.w3.org/2000/svg" width="700" height="200">
                    <defs>
                        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#ffcc00;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#ff6600;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <path d="M300,15 L375,40 L375,105 L300,135 L225,105 L225,40 Z" fill="url(#grad1)" stroke="#ff6600" stroke-width="3" rx="15" />
                    <text x="50%" y="50%" font-family="Arial, sans-serif" font-size="36" fill="#ffffff" text-anchor="middle" alignment-baseline="middle" font-weight="bold" filter="url(#text-shadow)">
                        UniversAuto
                    </text>
                    <filter id="text-shadow" x="-20%" y="-20%" width="140%" height="140%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="4" />
                        <feOffset dx="3" dy="3" result="offsetblur" />
                        <feFlood flood-color="rgba(0,0,0,0.5)" />
                        <feComposite in2="offsetblur" operator="in" />
                        <feMerge>
                            <feMergeNode />
                            <feMergeNode in="SourceGraphic" />
                        </feMerge>
                    </filter>
                </svg>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @php
            $route = request()->route()->getName();
            @endphp

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link {{ str_contains($route, 'home') ? 'active' : '' }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('vehicle.index') }}" class="nav-link {{ str_contains($route, 'vehicle.') ? 'active' : '' }}">Véhicules</a>
                    </li>
                </ul>
                <!-- Les sections de connexion et déconnexion sont maintenant commentées -->
                <!--
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-sm login-btn" title="Connexion">
                            <i class="fas fa-lock"></i>
                        </a>
                    </li>
                    @endguest
    
                    @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm login-btn" title="Déconnexion">
                                <i class="fas fa-lock-open"></i>
                            </button>
                        </form>
                    </li>
                    @endauth
                </ul>
                -->
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
