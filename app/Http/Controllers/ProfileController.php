<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile');
    }
    public function namechange(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Name field must be required!'
        ]);
        User::find(Auth::id())->update([
            'name' => $request->name
        ]);
        return back()->with('success','Profile name updated successfully');
    }
    public function passwordchange(Request $request)
    {
        $request->validate([
            // 'oldPass' => 'required',
            // 'newPass' => 'required',
            // 'confirmPass' => 'required'
            '*' => 'required'
        ],[
            'oldPass.required' => 'Old Password field must be required!',
            'newPass.required' => 'New Password field must be required!',
            'confirmPass.required' => 'Confrim Password field must be required!'
        ]);
        // echo $request->oldPass;
        if(Hash::check($request->oldPass, Auth::User()->password)){
            if($request->newPass == $request->confirmPass){
                if(Hash::check($request->newPass, Auth::User()->password)){
                    return back()->with('matchedWithOld','New password can not be same as old password');
                }else{
                    User::find(Auth::id())->update([
                        'password' => bcrypt($request->newPass)
                    ]);
                    return back()->with('successPass','Profile password updated successfully');
                }
            }else{
                return back()->with('notMatched','New password not matched with confirm password!');
            }
        }else{
            return back()->with('failed','Old password not matched!');
        }
    }
    public function photochange(Request $request)
    {
        $request->validate([
            'photo' => 'required | image | file'
        ],[
            'photo.required' => 'Photo must be required!'
        ]);
        if(Auth::user()->profile_photo != 'default.jpg'){
            unlink(base_path('public/uploads/profile_users/'.Auth::user()->profile_photo));
        }
        $manager = new ImageManager(new Driver());
        $new_profile_img_name = Auth::id().'-'.time().'-'.Str::random(5).'.'.$request->file('photo')->getClientOriginalExtension();
        // $img = $manager->read($request->file('photo'))->scale(width: 300)->save(base_path('public/uploads/profile_users/'.$new_profile_img_name));
        $img = $manager->read($request->file('photo'))->resize(300,300)->save(base_path('public/uploads/profile_users/'.$new_profile_img_name));
        User::find(Auth::id())->update([
            'profile_photo' => $new_profile_img_name
        ]);
        return back()->with('success_photo', 'Image uploaded successfully!');
        // return back()->with([
        //     'success_photo' => 'Image uploaded successfully!',
        //     'another' => 'Another message'
        // ]);
    }
}
