<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Request $request, Album $album)
    {
        $data = $request->validate([
            'images' => ['required','array'],
            'images.*' => ['image','max:8192'], // 8MB
        ]);

        $maxSort = (int) $album->photos()->max('sort_order');

        foreach ($request->file('images') as $i => $file) {
            Photo::create([
                'album_id' => $album->id,
                'image_path' => $file->store('albums/photos', 'public'),
                'sort_order' => $maxSort + $i + 1,
                'is_published' => true,
            ]);
        }

        return back()->with('success', 'Uploaded photos successfully');
    }

    public function update(Request $request, Photo $photo)
    {
        $data = $request->validate([
            'caption' => ['nullable','string','max:255'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_published' => ['nullable','boolean'],
        ]);

        $data['is_published'] = (bool)($request->boolean('is_published'));
        $photo->update($data);

        return back()->with('success', 'Updated photo successfully');
    }

    public function destroy(Photo $photo)
    {
        $albumId = $photo->album_id;
        $photo->delete();

        return redirect()->route('admin::albums.edit', $albumId)->with('success', 'Deleted photo successfully');
    }

    // optional: bulk sort (drag & drop ส่ง array id => order)
    public function sort(Request $request, Album $album)
    {
        $data = $request->validate([
            'orders' => ['required','array'], // [photo_id => sort_order]
        ]);

        foreach ($data['orders'] as $id => $order) {
            Photo::where('id', $id)->where('album_id', $album->id)->update(['sort_order' => (int)$order]);
        }

        return back()->with('success', 'Sorted successfully');
    }
}
