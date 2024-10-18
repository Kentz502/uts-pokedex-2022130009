@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .custom-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .card-text strong {
            color: #007bff;
        }

        .img-thumbnail {
            border: none;
            border-radius: 10px 10px 0 0;
            max-height: 200px;
            object-fit: cover;
        }

        .btn-custom {
            border-radius: 30px;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            gap: 5px;
        }

        .card-body {
            padding: 20px;
        }
    </style>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Pokémon List</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="text-right mb-3">
            <a href="{{ route('pokemon.create') }}" class="btn btn-success btn-custom">Add Pokémon</a>
        </div>

        <div class="row">
            @if($pokemons->isEmpty())
                <div class="col-12 text-center">
                    <p>No Pokémon found.</p>
                </div>
            @else
                @foreach($pokemons as $pokemon)
                    <div class="col-md-4 mb-4">
                        <div class="card custom-card h-100">
                            <a href="{{ route('pokemon.show', $pokemon) }}">
                                <img src="{{ Storage::url($pokemon->photo) ?? 'https://placehold.co/200' }}" class="img-thumbnail w-100" alt="{{ $pokemon->name }}">
                            </a>
                            <div class="card-body text-center">
                                <h5 class="card-title text-uppercase font-weight-bold">{{ $pokemon->name }}</h5>
                                <p class="card-text">
                                    <strong>ID:</strong> {{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }}<br>
                                    <strong>Species:</strong> {{ $pokemon->species }}<br>
                                    <strong>Primary Type:</strong> {{ $pokemon->primary_type }}<br>
                                    <strong>Power:</strong> {{ $pokemon->hp + $pokemon->attack + $pokemon->defense }}
                                </p>
                                <div class="btn-group">
                                    <a href="{{ route('pokemon.show', $pokemon) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('pokemon.edit', $pokemon) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('pokemon.destroy', $pokemon) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $pokemons->links() }}
        </div>
    </div>
@endsection
