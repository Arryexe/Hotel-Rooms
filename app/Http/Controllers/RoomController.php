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

}