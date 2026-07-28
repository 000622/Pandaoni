<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteImageController extends Controller
{
    public function index()
    {
        $images = SiteImage::orderBy('label')->get();
        return view('admin.site-images.index', compact('images'));
    }

    public function update(Request $request, SiteImage $siteImage)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($siteImage->image) {
            Storage::disk('public')->delete($siteImage->image);
        }

        $siteImage->update([
            'image' => $request->file('image')->store('site', 'public'),
        ]);

        return back()->with('success', "Gambar '{$siteImage->label}' berhasil diupdate.");
    }
}