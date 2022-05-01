<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use DB;
use Hash;
use File;

use App\Models\Product;
use App\Models\Category;

class TestController extends Controller {
   


   protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

   public function index() {
  


	$products = DB::table('products')
    ->join('categories', 'products.categorie_id', '=', 'categories.id','left')
     ->select('products.id', 'products.name', 'categories.title','products.slug',
     'products.image','products.price','products.description')
       -> get();

     return view('welcome',compact('products'))->with('products', $products);





   }



    public function search(Request $request){

         $search = $request->input('product');

     if($request->ajax()) {
          
            $data = Product::where('name', 'LIKE', $search.'%')
                ->get();
           
            $output = '';
           
            if (count($data)>0) {
              
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
              
                foreach ($data as $row){
                   
                    $output .= '<li class="list-group-item"><a href="#">'.$row->name.'</a></li>';
                }
              
                $output .= '</ul>';
            }
            else {
             
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
           
            return $output;
        }


  

    // Search in the title and body columns from the posts table
    $product = Product::with('category')
        ->where('name', 'LIKE', "%{$search}%")
        ->orWhere('price', 'LIKE', "%{$search}%")
        ->get();

    // Return the search view with the resluts compacted
    return view('results', compact('product'));

    }


   public function about(){

     $title = 'About';
		$today =  Carbon::now();
        return view('about',compact('title'),['today' => $today]);
   }


}
