<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $courts = Court::all();
        return view('customer.index', compact('courts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'booking_date'   => 'required|date',
            'court_id'       => 'required|exists:courts,id',
            'start_time'     => 'required',
            'duration_hours' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $court = Court::findOrFail($request->court_id);
            $subtotal = $court->price_per_hour * $request->duration_hours;

            $booking = Booking::create([
                'customer_name'  => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'booking_date'   => $request->booking_date,
                'total_price'    => $subtotal,
                'status'         => 'Pending',
            ]);

            BookingDetail::create([
                'booking_id'     => $booking->id,
                'court_id'       => $court->id,
                'start_time'     => $request->start_time,
                'duration_hours' => $request->duration_hours,
                'subtotal'       => $subtotal,
            ]);

            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Reservasi berhasil dikirim! Silakan melakukan konfirmasi pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses reservasi: ' . $e->getMessage());
        }
    }

    public function adminDashboard()
    {
        $bookings = Booking::with('bookingDetails.court')->latest()->get();
        return view('admin.dashboard', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Status booking #' . $booking->id . ' berhasil diperbarui!');
    }
}