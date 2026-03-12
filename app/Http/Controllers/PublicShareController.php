<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumShare;
use Illuminate\Http\Request;

class PublicShareController extends Controller
{
    public function index(string $slug){
        //ค้นหา share ที่ active และ album slug ตรงกัน
        $album = Album::where('slug', $slug)
                      ->where('is_published', true)
                      ->where(fn($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>=', now()->toDateString()))
                      ->firstOrFail();

        // นับทุกครั้งที่เข้า (atomic)
        $album->increment('view_count');
        $album->forceFill(['last_viewed_at' => now()])->save();

        return view('sharing-image', compact('album'));
    }
    public function show(Request $request,string $slug, string $token)
    {
        $share = AlbumShare::where('token', $token)->firstOrFail();

        //check album
        if (!$share->album) {
            abort(404);
        }

        //check slug
        if ($share->album->slug !== $slug) {
            abort(404);
        }

        //check is_published
        if(!$share->album->is_published){
            abort(404);
        }

        abort_unless($share->isActive(), 403);

        // นับทุกครั้งที่เข้า (atomic)
        $share->increment('view_count');
        $share->forceFill(['last_viewed_at' => now()])->save();

        // โหลด album + photos ที่ publish
        $album = $share->album()
                       ->with(['photos' => fn($q) => $q->where('is_published', true)->orderBy('sort_order')])
                       ->firstOrFail();

        return view('sharing-image', compact('album','share'));
    }
}
