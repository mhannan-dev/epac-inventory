<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\UserStoreRequest;
use Illuminate\Support\Facades\DB;



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
      $request->validate([
            'role_id' => 'required',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:150|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ],
        [
            'role_id.required'  => 'Please select role',
            'name.required'  => 'Please enter name',
            'username.required'  => 'Please enter username',
            'email' => 'Please enter email',
            'password' => 'Please Enter password',
            'image' => 'Please select an image',
        ]);

        //return $request->all();
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = time();
            $folder = '/upload/user';
            $filePath = $folder . $imageName. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $imageName);
            $user->image = $filePath;
        }

        $user           = new User();
        $user->role_id = $request->role_id;
        $user->name     = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email    = $request->email;
        $user->image = $imageName.'.'.$image->getClientOriginalExtension();
        $user->save();
        //dd($user);

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
        //dd($editData);
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
