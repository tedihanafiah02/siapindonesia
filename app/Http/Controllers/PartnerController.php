<?php

namespace App\Http\Controllers;

use App\Models\Gallery; // Import model Gallery
use App\Models\Partner; // Import model Partner
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        // Ambil semua data partner
        $partners = Partner::all();

        // Ambil semua data gallery (jika diperlukan)
        $galleries = Gallery::all();

        // Kirim data ke view
        return view('front.gallery', compact('partners', 'galleries'));
    }
}