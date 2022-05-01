<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use Session;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Hash;
use File;



class ProductController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {


      //name,slug,price,description,image
		$products = DB::table('products')
    ->join('categories', 'products.categorie_id', '=', 'categories.id','left')
     ->select('products.id', 'products.name', 'categories.title','products.slug',
     'products.image','products.price','products.description')
       -> get();
        return view('admin.products.index')->with('products', $products);
    }





  public function categories()
{
    return DB::table('categories')->pluck('title', 'id');

}
    public function create() {
        $title = "Create Products";
        $categories = \App\Models\Category::get()->pluck('title', 'id');
        return view("admin.products.create", compact('title','categories'));
    }
    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$product = Product::where('id', $id)->first();
        $cat = DB::table('categories')->pluck('id', 'title');
        $product = DB::table('products')
        ->join('categories', 'products.categorie_id', '=', 'categories.id','left')
         ->select('products.id', 'products.name', 'categories.title','products.slug',
         'products.image','products.price','products.description','products.created_at')

            ->where('products.id', '=',$id)
            ->first();


        return view('admin.products.show')->with(['product' => $product, 'cat' => $cat]);
    }


    public function store(Request $request){

///'name','slug','description','price','image',

  $prod = new Product();
  $categorie = \App\Models\Category::get()->pluck('title', 'id');
    $this -> validate($request, [
    'name' => 'required',
    'slug' => 'required',
    'price' => 'required',
    'description' => 'required']);

    $prod->name = $request->name;
    $prod->slug = $request->slug;
    $prod->price = $request->price;
    $prod->description = $request->description;
    $prod->categorie_id =  $request->categorie;



    if ($request->hasFile('image')) {
      //$file = Input::file('image');
      $file = $request->file('image');
      //getting timestamp
      $timestamp = str_replace([' ', ':'], '-', Carbon::now() -> toDateTimeString());

      $name = $timestamp . '-' . $file -> getClientOriginalName();
      $data['image'] = 'uploads/' . $request->file('image')->getClientOriginalName();
      $prod->image = $name;

      $file->move(public_path() . '/uploads/', $name);
      //dd($name);

    }

    $prod->save();

    //dd($prod);
    $request->session()->flash('message', 'Product successfully added!');

    return back();

  }

  public function edit($id){


    $product = Product::find($id);

    $cat = $this->categories();

  return view('admin.products.edit', compact('id','cat'),['product' => $product]);


  }
  public function update($id, Request $request){


    $product = Product::findOrFail($id);
    $cat = Category::find($id);
    $this -> validate($request, [
    'name' => 'required',
    'slug' => 'required',
    'price' => 'required',
    'description' => 'required']);

  //  $input = $request->all();

    if($request->hasFile('image') ){
      $file = $request->file('image');
     // $product->image = $filename;
     $timestamp = str_replace([' ', ':'], '-', Carbon::now() -> toDateTimeString());
     $name = $timestamp . '-' . $file -> getClientOriginalName();
     $data['image'] = 'uploads/' . $request->file('image')->getClientOriginalName();
     $product->image = $name;

     $file->move(public_path() . '/uploads/', $name);
 }

 $product->name = $request->name;
 $product->slug = $request->slug;
 $product->price = $request->price;
 $product->description = $request->description;
 $product->categorie_id =  $request->categorie_id;
$product->save();

  $request->session()->flash('message', 'Users successfully Updated!');

 return redirect()->route('admin.products.index');

  }
  public function destroy($id) {

    /*-----------here is our delete-----*/
     $prod = Product::findOrFail($id);
     File::delete(public_path() . '/uploads/' , $prod->image);
     $prod->delete();
       return back();
    Session::flash('flash_message', 'Task successfully deleted!');


    }

    public function massDestroy(Request $request)
      {
          Product::whereIn('id', request('ids'))->delete();

          return response(null, Response::HTTP_NO_CONTENT);
      }


}
