<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::latest()->paginate(15);
        return view('admin.albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'slug' => ['nullable','string','max:255', 'unique:albums,slug'],
            'subtitle' => ['nullable','string','max:255'],
            'hero_image' => ['nullable','image','max:10240'], // 5MB
            'mb_hero_image' => ['nullable','image','max:10240'], // 5MB
            'is_published' => ['nullable','boolean'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_published'] = (bool)($request->boolean('is_published'));

        if ($request->hasFile('hero_image') && $request->file('hero_image')->isValid()) {
            $data['hero_image'] = $request->file('hero_image')->store('albums/hero', 'public');
        }
        if ($request->hasFile('mb_hero_image') && $request->file('mb_hero_image')->isValid()) {
            $data['mb_hero_image'] = $request->file('mb_hero_image')->store('albums/hero', 'public');
        }

        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        Album::create($data);

        return redirect()->route('admin::albums.index')->with('success', 'Created album successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $album->load(['photos', 'shares']);
        return view('admin.albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'slug' => ['nullable','string','max:255', Rule::unique('albums','slug')->ignore($album->id)],
            'subtitle' => ['nullable','string','max:255'],
            'hero_image' => ['nullable','image','max:10240'],
            'mb_hero_image' => ['nullable','image','max:10240'],
            'is_published' => ['nullable','boolean'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_published'] = (bool)($request->boolean('is_published'));

        if ($request->hasFile('hero_image') && $request->file('hero_image')->isValid()) {
            $data['hero_image'] = $request->file('hero_image')->store('albums/hero', 'public');
        }

        if ($request->hasFile('mb_hero_image') && $request->file('mb_hero_image')->isValid()) {
            $data['mb_hero_image'] = $request->file('mb_hero_image')->store('albums/hero', 'public');
        }

        if ($data['is_published'] && !$album->published_at) {
            $data['published_at'] = now();
        }

        $album->update($data);

        return back()->with('success', 'Updated album successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('admin::albums.index')->with('success', 'Deleted album successfully');
    }
}
