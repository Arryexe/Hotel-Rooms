<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function index(Request $request) {
    	$keyword = '%'.$request->get('search').'%';

    	$categories = Category::where('name', 'like', $keyword)
    	->orWhere('price', 'like', $keyword)->get();

    	return view('categories.index', compact('categories'));
    }

    public function create() {
    	return view('categories.create');
    }

    public function store(Request $request){

    	$category = new Category;

    	$category->name = $request->get('name');
    	$category->price = $request->get('price');
    	$category->save();

    	return redirect('categories');
    }

   public function detail($id) {

    	$categories = Category::find($id);

    	return view('categories.detail', compact('categories'));
    }

}
