@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $pokemon->name }}</h1>
        <p>Species: {{ $pokemon->species }}</p>
        <p>Primary Type: {{ $pokemon->primary_type }}</p>
        <p>Power: {{ $pokemon->hp + $pokemon->attack + $pokemon->defense }}</p>
        <img src="{{ $pokemon->photo ? Storage::url($pokemon->photo) : 'https://placehold.co/200' }}" class="img-fluid rounded-start" alt="{{ $pokemon->name }}">
    </div>
@endsection
