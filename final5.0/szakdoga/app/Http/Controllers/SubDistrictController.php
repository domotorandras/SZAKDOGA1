<?php

namespace App\Http\Controllers;

use App\Models\SubDistrict;
use Illuminate\Http\Request;

class SubDistrictController extends Controller
{

    public function game(){
        return view('subdistricts');
    }

    public function leaderboard(){
        $records = SubDistrict::orderBy('score', 'desc') ->get(); 
        return view('leaderboard', ["records" => $records]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'score'     => 'required|integer|min:0|max:100',
            'player_id' => 'required|exists:players,id'
        ]);

        SubDistrict::create($validatedData);

        return redirect()->route('subdistricts.leaderboard')
                         ->with('success', 'Score saved successfully!');
    }
}
