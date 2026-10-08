<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourtController extends Controller
{
    public function index()
    {
        $courts = Court::latest()->get();

        return view('admin.courts.index', compact('courts'));
    }

    public function create()
    {
        return view('admin.courts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Futsal,Badminton,Basket',
            'price_per_hour' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('courts', 'public');
        }

        Court::create($validated);

        return redirect()
            ->route('admin.courts.index')
            ->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function show(Court $court)
    {
        return view('admin.courts.show', compact('court'));
    }

    public function edit(Court $court)
    {
        return view('admin.courts.edit', compact('court'));
    }

    public function update(Request $request, Court $court)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Futsal,Badminton,Basket',
            'price_per_hour' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($court->image) {
                Storage::disk('public')->delete($court->image);
            }

            $validated['image'] = $request->file('image')
                ->store('courts', 'public');
        }

        $court->update($validated);

        return redirect()
            ->route('admin.courts.index')
            ->with('success', 'Lapangan berhasil diperbarui.');
    }

    public function destroy(Court $court)
    {
        if ($court->image) {
            Storage::disk('public')->delete($court->image);
        }

        $court->delete();

        return redirect()
            ->route('admin.courts.index')
            ->with('success', 'Lapangan berhasil dihapus.');
    }
}