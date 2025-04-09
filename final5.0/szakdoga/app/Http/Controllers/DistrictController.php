<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function game(){
        return view('districts');
    }

    public function leaderboard(){
        $records = District::orderBy('score', 'desc') ->get(); 
        return view('leaderboard', ["records" => $records]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'score'     => 'required|integer|min:0|max:100',
            'player_id' => 'required|exists:players,id'
        ]);

        District::create($validatedData);

        return redirect()->route('districts.leaderboard')
                         ->with('success', 'Score saved successfully!');
    }
}
