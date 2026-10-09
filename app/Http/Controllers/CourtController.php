<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourtController extends Controller
{
    public function index()
    {
        $courts = Court::latest()->paginate(10);
        return view('admin.courts.index', compact('courts'));
    }

    public function create()
    {
        return view('admin.courts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Futsal,Badminton,Basket',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courts', 'public');
        }

        Court::create([
            'name' => $request->name,
            'type' => $request->type,
            'price_per_hour' => $request->price_per_hour,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('courts.index')->with('success', 'Data lapangan berhasil ditambahkan!');
    }

    public function edit(Court $court)
    {
        return view('admin.courts.edit', compact('court'));
    }

    public function update(Request $request, Court $court)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Futsal,Badminton,Basket',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $court->image;
        if ($request->hasFile('image')) {
            if ($court->image && Storage::disk('public')->exists($court->image)) {
                Storage::disk('public')->delete($court->image);
            }
            $imagePath = $request->file('image')->store('courts', 'public');
        }

        $court->update([
            'name' => $request->name,
            'type' => $request->type,
            'price_per_hour' => $request->price_per_hour,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('courts.index')->with('success', 'Data lapangan berhasil diperbarui!');
    }

    public function destroy(Court $court)
    {
        if ($court->image && Storage::disk('public')->exists($court->image)) {
            Storage::disk('public')->delete($court->image);
        }
        $court->delete();

        return redirect()->route('courts.index')->with('success', 'Data lapangan berhasil dihapus!');
    }
}