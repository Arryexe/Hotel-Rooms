<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Room;

class RoomStatusController extends Controller
{
     public function store(Request $request,$roomId) {

    	$room = Room::find($roomId);

    	if ($request->get('status') == 'Booking') {
    		$room->booking_time = date('Y-m-d H:i:s');
			$room->status = 'Booking';
			$room->customer_name = $request->get('customer_name');
			$room->notes = $request->get('notes');
			$room->save();
    	} else {
    		$room->booking_time = date('Y-m-d H:i:s');
			$room->checkin_time = date('Y-m-d H:i:s');
			$room->status = 'Check In';
			$room->customer_name = $request->get('customer_name');
			$room->notes = $request->get('notes');
			$room->save();
    	}

    	return redirect('rooms/'.$room->id);

    }

    public function checkin(Request $request, $roomId) {
    	$room = Room::find($roomId);

    	$room->status = $request->get('status');
    	$room->checkin_time = date('Y-m-d H:i:s');
    	$room->save();

    	return redirect('rooms/'.$room->id);
    }

    public function checkout(Request $request, $roomId) {
    	$room = Room::find($roomId);

    	$room->status = $request->get('status');
    	$room->checkout_time = date('Y-m-d H:i:s');
    	$room->save();

    	return redirect('rooms/'.$room->id);
    }
}
