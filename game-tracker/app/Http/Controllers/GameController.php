<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::latest()->get();
        return view('games.index', compact('games'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'platform' => 'required|string',
            'status' => 'required|in:Backlog,Playing,Completed',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        Game::create($validated);

        return redirect()->route('games.index')->with('success', 'Game added successfully!');
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'status' => 'required|in:Backlog,Playing,Completed',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $game->update($validated);

        return redirect()->route('games.index')->with('success', 'Game updated!');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game removed!');
    }
}
