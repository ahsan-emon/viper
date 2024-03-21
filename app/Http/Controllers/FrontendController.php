<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.index',[
            'categories' => Category::all()
        ]);
    }
}
