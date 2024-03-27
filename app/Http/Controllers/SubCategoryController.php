<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::paginate(2);
        return view('subCategory.index', compact('categories','subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            '*' => 'required',
            'subcategory_photo' => 'required | image'
        ]);
        $manager = new ImageManager(new Driver());
        $subcategory_img = Auth::id().'-'.time().'-'.Str::random(5).'.'.$request->file('subcategory_photo')->getClientOriginalExtension();
        $manager->read($request->file('subcategory_photo'))->resize(600, 350)->save(base_path('public/uploads/subcategory_photos/'.$subcategory_img));
        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_tagline' => $request->subcategory_tagline,
            'subcategory_photo' => $subcategory_img,
            'created_at' => Carbon::now()
        ]);
        return back()->with('success','Subcategory added successfully!');
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
        echo "sdfds";
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
        $subcategory = Subcategory::find($id);
        unlink(base_path('public/uploads/subcategory_photos/'.$subcategory->subcategory_photo));
        $subcategory->delete();
        return back()->with('delete','Subcategory successfully deleted!');
    }
}
