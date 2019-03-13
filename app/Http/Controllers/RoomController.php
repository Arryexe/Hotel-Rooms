<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Room;

class RoomController extends Controller
{
    
    // Index
	public function index(Request $request) {

		$search = '%'.$request->get('search').'%';

		$rooms = Room::where('number', 'like', $search)
		->orWhereHas('category', function ($query) use($search) {$query->where('name', 'like', $search);})
		->orWhere('status', 'like', $search)->get();

		return view('rooms.index', compact('rooms'));
	}

	// Create Data
	public function create() {
		$categories = Category::all();
		$existingRooms = Room::all()->pluck('number')->toArray();
		$floor1 = range(101, 110);
		$floor2 = range(201, 210);
		$numbers = array_merge($floor1, $floor2);

		$availableNumbers = array_diff($numbers, $existingRooms);

		return view('rooms.create', compact('categories', 'availableNumbers'));
	}

	public function store(Request $request) {

		$room = new Room;

		$room->number = $request->get('number');
		$room->category_id = $request->get('category_name');
		$room->status = $request->get('status');
		$room->save();

		return redirect('rooms');

	}

	// Detail
	public function detail($id) {
		$room = Room::find($id);		

		return view('rooms.detail', compact('room'));
	}

	// Detail -> Update
	public function edit($id) {
		$categories = Category::all();
		$room = Room::find($id);

		$existingRooms = Room::find($id)->pluck('number')->toArray();
		$floor1 = range(101, 110);
		$floor2 = range(201, 210);
		$numbers = array_merge($floor1, $floor2);

		$availableNumbers = array_diff($numbers, $existingRooms);

		return view('rooms.update', compact('categories', 'availableNumbers', 'room'));
	}

	public function update(Request $request) {
		$room = new Room;

		$room->number = $request->get('number');
		$room->category_id = $request->get('category_name');
		$room->status = $request->get('status');
		$room->customer_name = $request->get('customer_name');
		$room->checkin_time = $request->get('check_in');
		$room->checkout_time = $request->get('check_out');
		$room->notes = $request->get('notes');
		$room->save();

		return redirect('rooms/'. $room->id);
	}
}