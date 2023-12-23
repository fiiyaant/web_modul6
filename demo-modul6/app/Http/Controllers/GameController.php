<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Games;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Games::all();
        return response()->json($games);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $game = new Games;
        $game->title = $request->title;
        $game->genre = $request->genre;
        $game->stok = $request->stok;

        $game->save();
        return response()->json([
            "message" => "Games Added"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $game = Games::find($id);
        if (!empty($game)) {
            return response()->json($game);
        } else {
            return response()->json([
                "message" => "Game not Found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Games::where('id', $id)->exists()) {
            $game = Games::find($id);
            $game->title = is_null($request->title) ? $game->title : $request->title;
            $game->genre = is_null($request->genre) ? $game->genre : $request->genre;
            $game->stok = is_null($request->stok) ? $game->stok : $request->stok;
            $game->save();

            return response()->json([
                "message" => "Game Updated"
            ], 404);
        } else {
            return response()->json([
                "message" => "Game not Found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Games::where('id', $id)->exists()) {
            $game = Games::find($id);
            $game->delete();

            return response()->json([
                "message" => "Game Deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Game not Found"
            ], 404);
        }
    }
}
