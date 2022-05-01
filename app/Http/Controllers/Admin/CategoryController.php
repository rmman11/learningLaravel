<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Session;
use Validator, Redirect;
use DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {


            $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::first()->get();

  // dd($categories);
          return view('admin.categories.create')->with([
            'categories'  => $categories
          ]);
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->except('_token');

        Category::create($data);


        //dd($data);
        return redirect()->route('admin.categories.index')->withSuccess('You have successfully created a Category!');
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_cat($id)
    {

/*
        $category = DB::table('categories') -> find($id);
        return view('categories.edit_cat', ['category' => $category]);*/

        $category = Category::findOrFail($id);
        return view('admin.categories.edit_cat', compact('category'));


    }

    /**
     * Update Category in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $category = Category::findOrFail($id);
        $category->update($request->all());



        return redirect()->route('admin.categories.index');
    }





    /**
     * Remove Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $category = Category::findOrFail($id);
        $category->delete();

    return back();
    }
}
