@extends('admin.admin')

@section('title', 'Tous les véhicules')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
    <h1 class="mb-2 mb-md-0">@yield('title')</h1>
    <a href="{{ route('admin.vehicle.create') }}" class="btn btn-primary">Ajouter un véhicule</a>
</div>

<!-- Barre de recherche améliorée -->
<div class="mb-3">
    <form action="{{ route('admin.vehicle.index') }}" method="GET" class="d-flex flex-column flex-md-row gap-2">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Rechercher par marque ou modèle">
        <input type="text" name="reference" value="{{ request('reference') }}" class="form-control" placeholder="Référence du véhicule">
        <input type="text" name="owner_name" value="{{ request('owner_name') }}" class="form-control" placeholder="Nom du propriétaire">
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Prix</th>
                <th>Année</th>
                <th>Carburant</th>
                <th>Localisation</th>
                <th>Nom du propriétaire</th>
                <th>Téléphone du propriétaire</th>
                <th>Référence</th> <!-- Nouvelle colonne pour la référence -->
                <th>Image</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->id }}</td>
                <td>{{ $vehicle->make }}</td>
                <td>{{ $vehicle->model }}</td>
                <td>{{ number_format($vehicle->price, 2, '.', ' ') }} Fcfa</td>
                <td>{{ $vehicle->year }}</td>
                <td>{{ $vehicle->fuel_type ?? 'N/A' }}</td>
                <td>{{ $vehicle->city ?? 'N/A' }}, {{ $vehicle->address ?? 'N/A' }}</td>
                <td>{{ $vehicle->owner_name ?? 'N/A' }}</td>
                <td>{{ $vehicle->owner_phone ?? 'N/A' }}</td>
                <td>{{ $vehicle->reference ?? 'N/A' }}</td> <!-- Affichage de la référence unique -->
                <td>
                    <a href="{{ route('admin.vehicle.upload', $vehicle) }}" class="btn btn-info btn-sm">Ajouter / Voir Images</a>
                </td>
                <td>
                    <div class="d-flex gap-2 w-100 justify-content-end">
                        <a href="{{ route('admin.vehicle.edit', $vehicle) }}" class="btn btn-primary btn-sm">Éditer</a>
                        <form action="{{ route('admin.vehicle.destroy', $vehicle) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?');">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
{{ $vehicles->links() }}

@endsection
