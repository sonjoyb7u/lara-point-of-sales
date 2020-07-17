<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Session;

class UserController extends Controller
{
    /**
     * Display/Show All User's...
     */
    public function index() {
        $all_user_data = User::orderBy('id', 'desc')->get();

        return view('admin.pages.user.index', compact('all_user_data'));

    }

    /**
     * Display User Create/Add form...
     */
    public function create() {
        return view('admin.pages.user.create');
    }

    /**
     * User Create/Add process...
     */
    public function store(Request $req) {
        $this->validate($req, [
            'user_type'=>'required',
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|required_with:password_confirmation|same:password_confirmation|min:6| max:15',

        ]);

        try {
            $user = new User();
            $user->user_type = $req->user_type;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = bcrypt($req->password);
            // return $user;

            if($user->save()) {
                getMessage('success', 'Success, User data has been Created.');
                return redirect()->route('user.index')->with('success', 'Success, User data has been Created.');;
            } else {
                getMessage('danger', 'Failed, User data has not been Created.');
                return redirect()->route('user.create')->with('danger', 'Failed, User data has not been Created!');
            }

        } catch (Exception $e) {
            getMessage('danger', $e->getMessage());
            return redirect()->back();
            
        }

    }

    /**
     * Display User Edit form show...
     */
    public function edit($id) {
        $id = base64_decode($id);
        $user = User::find($id);
        $id = base64_encode($user->id);

        return view('admin/pages/user/edit', compact('user', 'id'));
    }

    /**
     * User data Update process...
     */
    public function update(Request $req, $id) {
        $this->validate($req, [
            'user_type'=>'required',
            'name'=>'required',
            'email'=>'required',

        ]);

        try {
            $id = base64_decode($id);
            $user = User::find($id);
            $user->name = $req->name;
            $user->email = $req->email;
            $user->user_type = $req->user_type;

            if($user->save()) {
                getMessage('success', 'Success, User data has been updated.');
                return redirect()->route('user.index')->with('success', 'Success, User data has been updated.');
            } else {
                getMessage('danger', 'Failed, User data has not been updated!');
                return redirect()->route('user.edit')->with('danger', 'Failed, User data has not been updated!');
            }
            
        } catch (Exception $e) {
            getMessage('danger', $e->getMessage());
            return redirect()->back();
        }

    }

    public function destroy($id) {
        $id = base64_decode($id);
        $user = User::find($id);

        if($user->delete()) {
            getMessage('success', 'Success, User data has been Deleted.');
            return redirect()->route('user.index')->with('success', 'Success, User data has been Deleted.');
        } else {
            getMessage('danger', 'Failed, User data has not been deleted!');
            return redirect()->route('user.index')->with('warning', 'Failed, User data has not been deleted!');
        }
    }

    /**
     * User Active/Inactive status process using ajax call by post...
     */
    public function status(Request $req) {
        if($req->ajax()) {
           $user = User::where('id', $req->id)->first();
           $user->status = $req->status;
           $status = $user->status;

            if($status == 'active') {
                $user->save();
                getMessage('success', 'Success, Supplier data has been Activated.');
                return redirect()->back()->with('success', 'User status has been Activated.');
           } else {
               $user->save();
               getMessage('success', 'Success, Supplier data has been De-Activated.');
               return redirect()->back()->with('error', 'User status has been De-Activated.');
           }

        }
    }



    

}
