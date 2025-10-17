<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; // Import model Service
use App\Models\Gallery; // Import model Gallery
use App\Models\ContactInformation; // Import model ContactInformation

class FrontendController extends Controller
{
    public function home()
    {
        // Ambil semua layanan (grooming, clinic, hotel)
        $groomingServices = Service::where('type', 'grooming')->get();
        $clinicServices = Service::where('type', 'clinic')->get();
        $hotelServices = Service::where('type', 'hotel')->get();

        // Ambil informasi kontak untuk footer
        $contactInfo = ContactInformation::first(); // Ambil satu entri informasi kontak

        return view('frontend.home', compact('groomingServices', 'clinicServices', 'hotelServices', 'contactInfo'));
    }

    public function gallery()
    {
        $galleryPhotos = Gallery::all(); // Ambil semua foto dari galeri
        $contactInfo = ContactInformation::first();

        return view('frontend.gallery', compact('galleryPhotos', 'contactInfo'));
    }

    public function contact()
    {
        $contactInfo = ContactInformation::first(); // Ambil informasi kontak
        return view('frontend.contact', compact('contactInfo'));
    }
}