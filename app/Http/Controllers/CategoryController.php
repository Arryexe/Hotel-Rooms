<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request) {
    	$keyword = '%'.$request->get('search').'%';

    	$categories = category::where('name', 'like', $keyword)
    	->orWhere('price', 'like', $keyword)->get();

    	return view('categories.index', compact('categories'));
    }

}
