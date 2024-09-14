@extends('admin.admin')

@section('title', $vehicle->exists ? "Éditer un véhicule" : "Créer un véhicule")

@section('content')
<h1>@yield('title')</h1>

<form class="vstack gap-2" action="{{ route($vehicle->exists ? 'admin.vehicle.update' : 'admin.vehicle.store', $vehicle) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method($vehicle->exists ? 'put' : 'post')

    <div class="row">
        @include('shared.input', ['class' => 'col', 'label' => 'Marque', 'name' => 'make', 'value' => $vehicle->make])

        <div class="col row">
            @include('shared.input', ['class' => 'col', 'name' => 'model', 'value' => $vehicle->model])
            @include('shared.input', ['class' => 'col', 'name' => 'price', 'label' => 'Prix', 'value' => $vehicle->price])
        </div>
    </div>

    @include('shared.input', ['type' =>'textarea', 'name' => 'description', 'value' => $vehicle->description])

    <div class="row">
        @include('shared.input', ['class' => 'col', 'name' => 'year', 'label' => 'Année', 'value' => $vehicle->year])
        @include('shared.input', ['class' => 'col', 'name' => 'mileage', 'label' => 'Kilométrage', 'value' => $vehicle->mileage])
        @include('shared.input', ['class' => 'col', 'name' => 'color', 'label' => 'Couleur', 'value' => $vehicle->color])
    </div>

    <!-- Ajout du champ pour le carburant -->
    <div class="row">
        @include('shared.input', ['class' => 'col', 'name' => 'fuel_type', 'label' => 'Carburant', 'value' => $vehicle->fuel_type])
        @include('shared.input', ['class' => 'col', 'name' => 'city', 'label' => 'Ville', 'value' => $vehicle->city])
        @include('shared.input', ['class' => 'col', 'name' => 'address', 'label' => 'Adresse', 'value' => $vehicle->address])
    </div>

    <!-- Ajout du champ pour la référence -->
    <div class="row">
        @include('shared.input', ['class' => 'col', 'name' => 'reference', 'label' => 'Référence', 'value' => $vehicle->reference ?? ''])
    </div>

    <!-- Ajout des champs pour le propriétaire -->
    <div class="row">
        @include('shared.input', ['class' => 'col', 'name' => 'owner_name', 'label' => 'Nom du propriétaire', 'value' => $vehicle->owner_name ?? ''])
        @include('shared.input', ['class' => 'col', 'name' => 'owner_phone', 'label' => 'Téléphone du propriétaire', 'value' => $vehicle->owner_phone ?? ''])
    </div>

    <div class="row">
        @include('shared.input', ['class' => 'col', 'name' => 'location', 'label' => 'Emplacement', 'value' => $vehicle->location])
        @include('shared.input', ['class' => 'col', 'name' => 'registration_number', 'label' => 'Numéro d\'immatriculation', 'value' => $vehicle->registration_number])
    </div>

    @include('shared.select', ['name' => 'options', 'label' => 'Options', 'value' => $vehicle->options()->pluck('id'), 'multiple' => true])
    @include('shared.checkbox', ['name' => 'sold', 'label' => 'Vendu', 'value' => $vehicle->sold, 'options' => $options])

    <div class="form-group">
        <label for="images">Images</label>
        <input type="file" class="form-control" id="images" name="images[]" multiple>
        @if ($vehicle->exists)
            @foreach ($vehicle->images as $image)
                <img src="{{ asset($image->filename) }}" alt="Image du véhicule" class="img-fluid mt-2" style="max-width: 200px;">
            @endforeach
        @endif
    </div>

    <div>
        <button class="btn btn-primary">
            @if($vehicle->exists)
                Modifier
            @else
                Créer
            @endif
        </button>
    </div>
</form>
@endsection
