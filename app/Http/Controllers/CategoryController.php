<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            '*' => 'required'
        ],[
            'category_name.required' => 'Category Name must be required',
            'category_tagline.required' => 'Category Tagline must be required',
            'category_photo.required' => 'Category File must be required',
        ]);
        // photo upload start
        $manager = new ImageManager(new Driver());
        $category_photo = Auth::id().'-'.time().'-'.Str::random(5).'.'.$request->file('category_photo')->getClientOriginalExtension();
        //resize(600,328)-> //resize after read if need to resize image
        $manager->read($request->file('category_photo'))->resize(600,350)->save(base_path('public/uploads/category_photos/'.$category_photo));
        // photo upload end
        // db insert start
        Category::insert([
            'category_name' => $request->category_name,
            'category_tagline' => $request->category_tagline,
            'category_photo' => $category_photo,
            'created_at' => Carbon::now()
        ]);
        // db insert end
        return back()->with('success','Category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
