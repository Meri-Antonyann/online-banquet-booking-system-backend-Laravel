<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(Request $request){



            $booking = Booking::create([
                'user_id' =>auth()->user()->id,
                'name' => $request->name,
                'email' =>$request->email,
                'number' =>$request->number,
                'dateTo' =>$request->dateTo,
                'guests' =>$request->guests,
                'event' =>$request->event,
                'service' =>$request->service,
                'message' =>$request->message,
            ]);


            $booking->save();




    }

    public function getQueries(){
        $booking = Booking::all()->where('status', "Waiting") ;
        return response()->json([
            'booking'=>$booking
        ]);
    }

    public function getMyQueries(){
        $user = auth()->user();
        $bookings = Booking::with('remarks')->whereBelongsTo($user)->get();
        return response()->json($bookings);
    }

    public function approve($id){
        $booking = Booking::query()->where('id', '=', $id)->first();
        $booking->status = "Approved";
        $booking->save();
        return response()->json(['approved' => $booking]);
    }

    public function reject($id){
        $booking = Booking::query()->where('id', '=', $id)->first();
        $booking->status = "Rejected";
        $booking->save();
        return response()->json(['rejected' => $booking]);
    }

    public function counts(){
        $c=Booking::where('status', 'Approved')->get()->count();

        return response()->json(['count' => $c]);
    }

    public function approved(){
        $approvedBookings=Booking::where('status', 'Approved')->get()->count();

        return response()->json(['approved' => $approvedBookings]);
    }
    public function getApprovedBookings(){
        $approvedBookings=Booking::where('status', 'Approved')->get();

        return response()->json(['approved' => $approvedBookings]);
    }
    public function cancelled(){
        $cancelledBookings=Booking::where('status', 'Rejected')->get()->count();

        return response()->json(['cancelled' => $cancelledBookings]);
    }
    public function getCancelledBookings(){
        $cancelledBookings=Booking::where('status', 'Rejected')->get();

        return response()->json(['cancelled' => $cancelledBookings]);
    }

    public function newBooking(){
        $mygetdate = Carbon::today()->subDays(15);
        $new = Booking::where('created_at', '>=', $mygetdate)->get()->count();
        return response()->json(['new' => $new ]);
    }

    public function getNewBookings(){
        $mygetdate = Carbon::today()->subDays(15);
        $new = Booking::where('created_at', '>=', $mygetdate)->get();
        return response()->json(['new' => $new ]);
    }
    public function getUnreadBookings(){
        $unreadBookings=Booking::where('status', 'Waiting')->get();

        return response()->json(['unread' => $unreadBookings]);
    }
    public function unread(){
        $unreadBookings=Booking::where('status', 'Waiting')->get()->count();

        return response()->json(['unread' => $unreadBookings]);
    }
    public function getReadBookings(){
        $readBookings=Booking::where('status', 'Rejected')->orWhere('status', 'Approved')->get();

        return response()->json(['read' => $readBookings]);
    }
    public function ReadBookings(){
        $readBookings=Booking::where('status', 'Rejected')->orWhere('status', 'Approved')->get()->count();

        return response()->json(['read' => $readBookings]);
    }

    public function getBookings(){
        $bookings = Booking::all();
        return response()->json(['bookings' => $bookings ]);
    }

    public function search(Request $request){
        $data = Booking::where('name', 'LIKE','%'.$request->search.'%')->orWhere('id', 'LIKE','%'.$request->search.'%')->orWhere('email', 'LIKE','%'.$request->search.'%')->orWhere('number', 'LIKE','%'.$request->search.'%')->get();
        return response()->json($data);
    }

    public function searchdata($id){
        $data = Booking::where('id', $id)->get();
        return response()->json(['booking' => $data ]);
    }

    public function bookingsForSomePeriod(Request $request){

        $date1=$request->fromDate;
        $date2=Carbon::parse($request->toDate)->endOfDay();

        $data = DB::table('bookings')
            ->whereBetween('created_at', [$date1, $date2])->get();
        return response()->json(['bookings' => $data ]);
    }

}
