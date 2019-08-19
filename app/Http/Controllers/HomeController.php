<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\Product;
use Cart;
use Auth;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $category = Category::where('status',1)->get();
        $productType = ProductType::where('status',1)->get();
        view()->share(['category' => $category,'productType'=>$productType]);
        
    }
    public function index()
    {
        return view('client.pages.index');
    }
}
