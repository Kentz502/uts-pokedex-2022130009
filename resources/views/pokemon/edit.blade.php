@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 50px auto;
        }

        .btn-custom {
            border-radius: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        .form-control-file {
            margin-top: 10px;
        }
    </style>

    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Edit Pokémon - {{ $pokemon->name }}</h2>

            {{-- Error and validation messages --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form untuk mengedit Pokemon --}}
            <form action="{{ route('pokemon.update', $pokemon->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $pokemon->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="species">Species</label>
                    <input type="text" name="species" class="form-control" value="{{ old('species', $pokemon->species) }}" required>
                </div>

                <div class="form-group">
                    <label for="primary_type">Primary Type</label>
                    <select name="primary_type" class="form-control">
                        <option value="Grass" {{ old('primary_type', $pokemon->primary_type) == 'Grass' ? 'selected' : '' }}>Grass</option>
                        <option value="Fire" {{ old('primary_type', $pokemon->primary_type) == 'Fire' ? 'selected' : '' }}>Fire</option>
                        <option value="Water" {{ old('primary_type', $pokemon->primary_type) == 'Water' ? 'selected' : '' }}>Water</option>
                        <option value="Electric" {{ old('primary_type', $pokemon->primary_type) == 'Electric' ? 'selected' : '' }}>Electric</option>
                        <option value="Normal" {{ old('primary_type', $pokemon->primary_type) == 'Normal' ? 'selected' : '' }}>Normal</option>
                        <!-- Tambahkan opsi lainnya -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" name="weight" step="0.01" class="form-control" value="{{ old('weight', $pokemon->weight) }}" required>
                </div>

                <div class="form-group">
                    <label for="height">Height</label>
                    <input type="number" name="height" step="0.01" class="form-control" value="{{ old('height', $pokemon->height) }}" required>
                </div>

                <div class="form-group">
                    <label for="hp">HP</label>
                    <input type="number" name="hp" class="form-control" value="{{ old('hp', $pokemon->hp) }}" required>
                </div>

                <div class="form-group">
                    <label for="attack">Attack</label>
                    <input type="number" name="attack" class="form-control" value="{{ old('attack', $pokemon->attack) }}" required>
                </div>

                <div class="form-group">
                    <label for="defense">Defense</label>
                    <input type="number" name="defense" class="form-control" value="{{ old('defense', $pokemon->defense) }}" required>
                </div>

                <div class="form-group">
                    <label for="is_legendary">Is Legendary?</label>
                    <div>
                        <input type="radio" name="is_legendary" value="1" {{ old('is_legendary', $pokemon->is_legendary) ? 'checked' : '' }}> Yes
                        <input type="radio" name="is_legendary" value="0" {{ old('is_legendary', $pokemon->is_legendary) == 0 ? 'checked' : '' }}> No
                    </div>
                </div>

                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" class="form-control-file">
                    @if($pokemon->photo)
                        <img src="{{ Storage::url($pokemon->photo) }}" alt="{{ $pokemon->name }}" class="img-thumbnail mt-3" width="200">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-custom btn-block mt-4">Update Pokémon</button>
            </form>
        </div>
    </div>
@endsection
