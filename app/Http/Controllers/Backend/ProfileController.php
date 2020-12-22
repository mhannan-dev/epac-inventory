<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getIndex()
    {
        $data['title'] = "User Profile";
        $id = Auth::user()->id;
        $data['user'] = User::find($id);
        //dd($data);
        return view('backend.pages.user.view_profile',$data);
    }

    public function getEdit($id)
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('backend.pages.user.edit_profile',compact('editData'));
    }

    public function postUpdate(Request $request)
    {
        //dd($request);
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;

        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = time();
            $folder = '/upload';
            $filePath = $folder . $imageName. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $imageName);
            $data->image = $filePath;
        }
        $data->save();

        toast('Profile updated successfully !!','success');
        return redirect()->route('logged_in.user.profile.view');

    }
    public function getPasswordView()
    {
        $data['title'] = "Manage Password";
        $data['user'] = User::find(Auth::user()->id);
        return view('backend.pages.user.edit_password',$data);
    }

    public function postPasswordUpdate(Request $request)
    {
        if (Auth::attempt(['id'=>Auth::user()->id, 'password'=>$request->current_password])){
            //dd('Okay');
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            toast('Password Changed successfully!!','success');
            return redirect()->route('logged_in.user.profile.view');
        }else{
            //dd('error');
                toast('Current Password does not matched!!','warning');
                return redirect()->back();
        }
    }





}
