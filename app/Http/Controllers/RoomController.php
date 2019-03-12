<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Room;

class RoomController extends Controller
{
    
	public function index(Request $request) {

		$search = '%'.$request->get('search').'%';

		$rooms = Room::where('number', 'like', $search)
		->orWhereHas('category', function ($query) use($search) {$query->where('name', 'like', $search);})
		->orWhere('status', 'like', $search)->get();

		return view('rooms.index', compact('rooms'));
	}

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
}