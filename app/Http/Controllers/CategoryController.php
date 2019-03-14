<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function index(Request $request) {
    	$keyword = '%'.$request->get('search').'%';

    	$categories = Category::where('name', 'like', $keyword)
    	->orWhere('price', 'like', $keyword)
        ->withCount('room')
        ->get();

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

    public function edit($id) {

    	$categories = Category::find($id);

    	return view('categories.edit', compact('categories'));
    }

    public function update(Request $request, $id) {

    	$category = Category::find($id);

    	$category->name = $request->get('name');
    	$category->price = $request->get('price');
    	$category->save();

    	return redirect('categories/'. $category->id);
    }

    public function destroy($id) {

    	$category = Category::find($id)->delete();

    	return redirect('categories');
    }

}
