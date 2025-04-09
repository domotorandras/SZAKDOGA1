<?php

namespace App\Http\Controllers;

use App\Models\Guessr;
use Illuminate\Http\Request;

class GuessrController extends Controller
{

    public function game(){
        return view('guessr');
    }

    public function leaderboard(){
        $records = Guessr::orderBy('score', 'asc') ->get(); 
        return view('leaderboard', ["records" => $records]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'score'     => 'required|numeric|min:0',
            'player_id' => 'required|exists:players,id'
        ]);

        Guessr::create($validatedData);

        return redirect()->route('guessr.leaderboard')
                         ->with('success', 'Score saved successfully!');
    }
}
