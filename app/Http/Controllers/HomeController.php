<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\EmailOffer;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $total_users = User::count();
        $total_admin = User::where('role',2)->count();
        $total_customers = User::where('role',1)->count();
        return view('home',[
            'total_users' => $total_users,
            'total_admin' => $total_admin,
            'total_customers' => $total_customers,
        ]);
    }
    public function emailoffer()
    {
        return view('emailoffer', [
            'users' => User::where('role',1)->get()
        ]);
    }
    public function singleemailoffer($id)
    {
        Mail::to(User::find($id)->email)->send(new EmailOffer());
        return back()->with('success','Email sent successfully');
    }
    public function checkemailoffer(Request $request)
    {
        // echo $request->check;
        foreach($request->check as $id){
            Mail::to(User::find($id)->email)->send(new EmailOffer());
        }
        return back()->with('success','Email sent successfully');
    }
}
