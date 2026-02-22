<?php

namespace App\Http\Controllers;

use App\Models\AlbumShare;
use Illuminate\Http\Request;

class PublicShareController extends Controller
{
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
