@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($pokemon) ? 'Edit Pokémon' : 'Create New Pokémon' }}</h1>

    {{-- <form action="{{ isset($pokemon) ? route('pokemon.update', $pokemon->id) : route('pokemon.store') }}" method="POST" enctype="multipart/form-data"> --}}
        <form action="{{ route('pokemon.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($pokemon))
        @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $pokemon->name ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="species">Species</label>
            <input type="text" name="species" class="form-control" value="{{ old('species', $pokemon->species ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="primary_type">Primary Type</label>
            <select name="primary_type" class="form-control">
                <option value="Grass" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Grass' ? 'selected' : '' }}>Grass</option>
                <option value="Fire" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Fire' ? 'selected' : '' }}>Fire</option>
                <option value="Water" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Water' ? 'selected' : '' }}>Water</option>
                <option value="Electric" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Electric' ? 'selected' : '' }}>Electric</option>
                <option value="Normal" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Normal' ? 'selected' : '' }}>Normal</option>
                <option value="Fighting" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Fighting' ? 'selected' : '' }}>Fighting</option>
                <option value="Poison" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Poison' ? 'selected' : '' }}>Poison</option>
                <option value="Ground" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Ground' ? 'selected' : '' }}>Ground</option>
                <option value="Fairy" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Fairy' ? 'selected' : '' }}>Fairy</option>
                <option value="Flying" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Flying' ? 'selected' : '' }}>Flying</option>
                <option value="Psychic" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Psychic' ? 'selected' : '' }}>Psychic</option>
                <option value="Bug" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Bug' ? 'selected' : '' }}>Bug</option>
                <option value="Rock" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Rock' ? 'selected' : '' }}>Rock</option>
                <option value="Ghost" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Ghost' ? 'selected' : '' }}>Ghost</option>
                <option value="Dragon" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Dragon' ? 'selected' : '' }}>Dragon</option>
                <option value="Dark" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Dark' ? 'selected' : '' }}>Dark</option>
                <option value="Steel" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Steel' ? 'selected' : '' }}>Steel</option>
                <option value="Ice" {{ old('primary_type', $pokemon->primary_type ?? '') == 'Ice' ? 'selected' : '' }}>Ice</option>
                <!-- Tambahkan tipe lainnya -->
            </select>
        </div>

        <!-- Input lainnya sepertiheight, height, hp, attack, defense, is_legendary -->
         <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" name="weight" class="form-control" value="{{ old('weight', $pokemon->weight ?? '') }}" required>
        </div>

          <div class="form-group">
            <label for="height">Height</label>
            <input type="number" name="height" class="form-control" value="{{ old('height', $pokemon->height?? '') }}" required>
        </div>

          <div class="form-group">
            <label for="hp">HP</label>
            <input type="number" name="hp" class="form-control" value="{{ old('hp', $pokemon->hp ?? '') }}" required>
        </div>

           <div class="form-group">
            <label for="defense">Defense</label>
            <input type="number" name="defense" class="form-control" value="{{ old('defense', $pokemon->defense ?? '') }}" required>
        </div>

        <div class="col-6">
                        <label class="form-label">Legendary</label>
                        <div>
                            <input type="radio" name="is_legendary" id="is_legendary" value="1" {{ old('is_legendary') ? 'checked' : '' }}>
                            <label for="is_legendary">Yes</label>
                        </div>
                    </div>

        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($pokemon) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
