<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemons = Pokemon::paginate(20);
        return view('pokemon.index', compact('pokemons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pokemon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'weight' => 'nullable|numeric|max:99999999|min:0',
            'height' => 'nullable|numeric|max:99999999|min:0',
            'hp' => 'nullable|integer|max:9999|min:0',
            'attack' => 'nullable|integer|max:9999|min:0',
            'defense' => 'nullable|integer|max:9999|min:0',
            'photo' => 'nullable|image|max:2048|mimes:jpeg,jpg,png,gif,svg',
        ]);


        $data = $request->except(['photo']);
        $data['is_legendary'] = $request->has('is_legendary') ? 1 : 0;


        Pokemon::create($data);

        return redirect()->route('pokemon.index')->with('success', 'Pokemon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pokemon $pokemon)
    {
        return view('pokemon.show', compact('pokemon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon)
    {
        return view('pokemon.edit', compact('pokemon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        $data = $request->except(['_token', '_method']);
        $data['is_legendary'] = $request->has('is_legendary') ? true : false;

        $pokemon->update($data);

        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|max:50',
            'weight' => 'required|numeric|min:0|max:999999',
            'height' => 'required|numeric|min:0|max:999999',
            'hp' => 'required|integer|min:0',
            'attack' => 'required|integer|min:0',
            'defense' => 'required|integer|min:0',
            'is_legendary' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        $pokemon = Pokemon::where('id', $pokemon->id);
        $pokemon->update($request->except(['_token', '_method']));
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->hashName();
            $filePath = $file->storeAs('public', $fileName);
            $pokemon->update(['photo' => $filePath]);
        }
        return redirect()->route('pokemon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();
        return redirect()->route('pokemon.index')->with('success', 'Pokemon deleted successfully.');
    }
}
