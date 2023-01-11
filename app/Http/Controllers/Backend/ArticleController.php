<?php

namespace App\Http\Controllers\Backend;

use App\Models\Article;
use App\Models\Caterory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('front.articles.index', compact('articles'));

    }
    public function create()
    { 
        $categories= Caterory::all();
        return view('front.articles.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $category = new Article();
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
