<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumShare;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class AlbumShareController extends Controller
{
    public function store(Request $request, Album $album)
    {
        $data = $request->validate([
            'name' => ['nullable','string','max:255'],
            'expires_at' => ['nullable','date'],
        ]);

        $share = AlbumShare::create([
            'album_id' => $album->id,
            'name' => $data['name'] ?? null,
            'expires_at' => $data['expires_at'] ?? null,
            'token' => Str::random(48), // ยาวพอเดาไม่ได้
            'created_by' => auth()->id(),
        ]);
        if(app()->environment('local')){
            $url = route('share.show', ['slug'=>$album->slug,'token'=>$share->token]);
        }else{
            $url = "https://imagesharing.uhresidencesbangkok.com/$album->slug/$share->token";
        }

        return back()->with('success', 'Created share link: '.$url);
    }

    public function revoke(AlbumShare $share)
    {
        $share->update(['revoked_at' => now()]);
        return back()->with('success', 'Revoked successfully');
    }

    public function restore(AlbumShare $share)
    {
        $share->update(['revoked_at' => null]);
        return back()->with('success', 'Restored successfully');
    }

    public function destroy(AlbumShare $share)
    {
        $share->delete();
        return back()->with('success', 'Deleted successfully');
    }
}
