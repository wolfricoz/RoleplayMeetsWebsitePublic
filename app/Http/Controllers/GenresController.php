<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genres;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function index()
    {
        return view('admin.genres', [

        ]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $attr = $request->validate([
            'name' => 'required',
        ]);
        Genres::create($attr);
        return redirect()->back()->with('success', "Genre {$request['name']} successfully created.");
    }

    public function update(Request $request, Genres $genre): \Illuminate\Http\RedirectResponse
    {
        $attr = $request->validate([
            'name' => 'required',
        ]);
        $genre->update($attr);
        return redirect()->back()->with('success', "Genre {$request['name']} successfully updated.");
    }

    public function destroy(Genres $genre): \Illuminate\Http\RedirectResponse
    {
        $genre->delete();
        return redirect()->back()->with('success', "Genre {$genre->name} successfully deleted.");
    }
}
