<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class FrontendController extends Controller
{
    public function index(){
        if(Category::where('status','show')->count() == 0){
            $categories = Category::latest()->limit(3)->get(); //limit(2)->get() for 2 category
        }else{
            $categories = Category::where('status','show')->get(); //limit(2)->get() for 2 category // latest()->limit(2)->get() for last 2 category
        }
        return view('frontend.index', compact('categories'));
    }
}
