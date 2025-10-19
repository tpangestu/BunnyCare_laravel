<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroomingBooking;
use App\Models\ClinicBooking;
use App\Models\HotelBooking;
use Illuminate\Support\Facades\Storage; // Untuk upload file

class BookingController extends Controller
{
    public function storeGroomingBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Validasi gambar
        ]);

        $proofOfPaymentPath = null;
        $proofPublicId = null;
        if ($request->hasFile('proof_of_payment')) {
            $uploadedFile = $request->file('proof_of_payment');
            $result = \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'bunny-care/proofs'
            ]);
            $proofOfPaymentPath = $result->getSecurePath();
            $proofPublicId = $result->getPublicId();
        }

        $booking = GroomingBooking::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'booking_date' => $request->booking_date,
            'proof_of_payment' => $proofOfPaymentPath,
            'proof_public_id' => $proofPublicId,
            'status' => 'pending', // Status default saat pertama kali mengisi form
        ]);

        return redirect()->route('booking.success', ['type' => 'grooming', 'id' => $booking->id]);
    }

    public function storeClinicBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $proofOfPaymentPath = null;
        $proofPublicId = null;
        if ($request->hasFile('proof_of_payment')) {
            $uploadedFile = $request->file('proof_of_payment');
            $result = \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'bunny-care/proofs'
            ]);
            $proofOfPaymentPath = $result->getSecurePath();
            $proofPublicId = $result->getPublicId();
        }

        $booking = ClinicBooking::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'booking_date' => $request->booking_date,
            'proof_of_payment' => $proofOfPaymentPath,
            'proof_public_id' => $proofPublicId,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.success', ['type' => 'clinic', 'id' => $booking->id]);
    }

    public function storeHotelBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Hitung total harga berdasarkan durasi inap dan harga per hari dari service
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $duration = $startDate->diffInDays($endDate);

        // Ambil harga per hari dari service hotel
        $hotelService = \App\Models\Service::where('type', 'hotel')->first();
        $pricePerDay = $hotelService ? $hotelService->price :5000; // fallback ke 50000 jika tidak ada

        $totalPrice = $duration * $pricePerDay;

        $proofOfPaymentPath = null;
        $proofPublicId = null;
        if ($request->hasFile('proof_of_payment')) {
            $uploadedFile = $request->file('proof_of_payment');
            $result = \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'bunny-care/proofs'
            ]);
            $proofOfPaymentPath = $result->getSecurePath();
            $proofPublicId = $result->getPublicId();
        }

        $booking = HotelBooking::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $totalPrice,
            'proof_of_payment' => $proofOfPaymentPath,
            'proof_public_id' => $proofPublicId,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.success', ['type' => 'hotel', 'id' => $booking->id]);
    }

    public function showBookingSuccess($type, $id)
    {
        switch ($type) {
            case 'grooming':
                $booking = GroomingBooking::find($id);
                $bookingTypeLabel = 'Grooming';
                break;
            case 'clinic':
                $booking = ClinicBooking::find($id);
                $bookingTypeLabel = 'Bunny Clinic';
                break;
            case 'hotel':
                $booking = HotelBooking::find($id);
                $bookingTypeLabel = 'Bunny Hotel';
                break;
            default:
                $booking = null;
                $bookingTypeLabel = '';
                break;
        }

        if (!$booking) {
            abort(404, 'Booking not found');
        }

        // Generate formatted booking code similar to admin panel
        switch ($type) {
            case 'grooming':
                $bookingCode = 'G' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);
                break;
            case 'clinic':
                $bookingCode = 'C' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);
                break;
            case 'hotel':
                $bookingCode = 'H' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);
                break;
            default:
                $bookingCode = '#' . $booking->id;
                break;
        }

        return view('frontend.booking-succes', compact('booking', 'type', 'bookingTypeLabel', 'bookingCode'));
    }
}