<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\Crud;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use File;

class ImageController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {


     $data = Crud::latest()->paginate(5);
        return view('admin.photos.index', compact('data'))
                ->with('i', (request()->input('page', 1) - 1) * 3);

    }

 public function create()
    {

  return view('admin.photos.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'image'         =>  'required|image|max:2048'
        ]);

        $image = $request->file('image');

        $crud = new  Crud();

      /*  $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $form_data = array(
            'first_name'       =>   $request->first_name,
            'last_name'        =>   $request->last_name,
            'image'            =>   $new_name
        );

        Crud::create($form_data);*/
    $crud->first_name = $request->first_name;
    $crud->last_name = $request->last_name;


    if ($request->hasFile('image')) {
      //$file = Input::file('image');
      $file = $request->file('image');
      //getting timestamp
      $timestamp = str_replace([' ', ':'], '-', Carbon::now() -> toDateTimeString());

      $name = $timestamp . '-' . $file -> getClientOriginalName();
      $data['image'] = 'images/' . $request->file('image')->getClientOriginalName();
      $crud->image = $name;

      $file->move(public_path() . '/images/', $name);
      //dd($name);

    }

    $crud->save();

           Session::flash('message', 'Successfully add the Task!');
           return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $data = Crud::findOrFail($id);
        return view('admin.photos.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = Crud::findOrFail($id);
        return view('admin.photos.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $request->validate([
                'first_name'    =>  'required',
                'last_name'     =>  'required',
                'image'         =>  'image|max:2048'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }
        else
        {
            $request->validate([
                'first_name'    =>  'required',
                'last_name'     =>  'required'
            ]);
        }

        $form_data = array(
            'first_name'       =>   $request->first_name,
            'last_name'        =>   $request->last_name,
            'image'            =>   $image_name
        );

        Crud::whereId($id)->update($form_data);

        return back()->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Crud::findOrFail($id);
        $data->delete();
        return back()->with(['message' => 'Author deleted successfully']);
    }

}
