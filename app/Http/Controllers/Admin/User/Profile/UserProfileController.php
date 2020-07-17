<?php

namespace App\Http\Controllers\Admin\User\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Exception;


class UserProfileController extends Controller
{
    /**
     * 
     */
    public function index() {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('admin.pages.user-profile.index', compact('user'));
    }

    /**
     * 
     */
    public function edit() {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('admin.pages.user-profile.edit', compact('user'));
    }

    /**
     * 
     */
    public function update(Request $request) {
        if($request->isMethod('PUT')) {
            $this->validate($request, [
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png',
            'gender'=>'required',

            ]);

            $id = Auth::user()->id;
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->address = $request->address;

            $image_file = $request->file('image');
            if($image_file) {
                @unlink(public_path('uploads/users/profile/' . $user->image));
                $new_image_file_name = date('Ymdhms') . '_' . $user->user_type . '.' . $image_file->getClientOriginalName();

                $image_file->move('uploads/users/profile/', $new_image_file_name);
                $user->image = $new_image_file_name;

            }

            if($user->save()) {
                getMessage('success', 'Success, User Profile data has been updated.');
                return redirect()->route('user.profile.index')->with('success', 'Success, User Profile data has been updated.');

            } else {
                getMessage('danger', 'Failed, User data has not been updated!');
                return redirect()->route('user.profile.edit')->with('danger', 'Failed, User Profile data has not been updated!');
            }

        }
           

    }

    public function passwordEdit() {
        return view('admin.pages.user-profile.password-edit');
    }

    public function passwordUpdate(Request $request) {
        if(Auth::attempt(['id' => Auth::user()->id, 'password' => $request->old_password])) {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->update();

            getMessage('success', 'Success, User Profile password changed successfully.');
            return redirect()->route('user.profile.index')->with('success', 'Success, User Profile Password changed successfully.');


        } else {
            return redirect()->back()->with('error', 'Failed, Old password does not matched!');

        }
    }


}
