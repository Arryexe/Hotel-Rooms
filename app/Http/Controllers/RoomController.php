<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Room;

class RoomController extends Controller
{
    
	public function index() {

		$category = Category::all();
		$rooms = Room::all();

		return view('rooms.index', compact('category', 'rooms'));
	}

}
