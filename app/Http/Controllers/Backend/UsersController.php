<?php

namespace App\Http\Controllers\Backend;
use App\Http\Traits\UploadTrait;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;



class UsersController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $data['title'] = "User";
        $data['all_user'] = User::all();
        //dd($data);
        return view('backend.pages.user.index',$data);
    }

    public function postStore(Request $request, User $user){
      //  dd($request->all());
      $request->validate([
            'role_id' => 'required',
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',

        ],
        [
            'role_id.required'  => 'Please select role',
            'name.required'  => 'Please enter name',
            'email' => 'Please enter email',
            'password' => 'Please Enter password',
           
        ]);

        $user           = new User();
        $user->role_id = $request->role_id;
        $user->name     = $request->name;
        $user->password = bcrypt($request->password);
        $user->email    = $request->email;
        $user->save();
        toast('Data added successfully !!','success');

        return redirect()->route('logged_in.user.view');

    }

    public function postDelete($id)
    {
        $delete_row = User::find($id);
        //dd($delete_row);
        if (!is_null($delete_row)) {
            $delete_row->delete();
        }

        toast('Data has deleted successfully !!','success');
        return back();
    }
    public function getCreate(){
         $user_roles = Role::all();
         //dd($user_roles);
        return view('backend.pages.user.create',compact('user_roles'));
    }

    public function getEdit($id)
    {
        $editData = User::find($id);
        return view('backend.pages.user.edit')->with(compact('editData'));
    }

    public function postUpdate(Request $request, $id)
    {
        $user           = User::find($id);
        $user->usertype = $request->usertype;
        $user->name     = $request->name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        toast('Data updated successfully !!','success');
        return redirect()->route('user.list');



    }

}
