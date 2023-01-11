<?php

namespace App\Http\Controllers\Backend;

use App\Models\Caterory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Caterory::all();
        return view('front.categories.index', compact('categories'));

    }
    public function create()
    { 
        return view('front.categories.create');
    }

    public function store(Request $request)
    {
        $category = new Caterory();
        $category->name=$request->name;
        $category->created_by=Auth()->user()->id;
        $category->save();
        return redirect()->route('categories.index')->with('message','Data saved successfully...');
    }
    public function edit($id)
    {
        $edit = Caterory::find($id);
        return view('front.categories.edit', compact('edit'));
    }

    public function update(Request $request,$id)
    {
        $category = Caterory::find($id);
        $category = new Caterory();
        $category->name=$request->name;
        $category->updated_by=Auth()->user()->id;
        $category->save();
        return redirect()->route('categories.index')->with('message','Data update successfully...');
    }

    public function delete($id)
    {
        $category = Caterory::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('error','Unit delete successffully...');
    }
}


