<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $customers = Customer::latest()->get();
//        return $customers;
        return view('admin.pages.customer.index', compact('customers'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('admin.pages.customer.create');
    }

    /**
     * @param  Request  $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $req) {
        $create = [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'created_by' => Auth::user()->name,
        ];
        $customer = Customer::create($create);

        if($customer) {
            getMessage('success', 'Success, Customer has been Created.');
            return redirect()->route('customer.index')->with('success', 'Success, Customer has been Created.');
        } else {
            getMessage('danger', 'Failed, Customer has not been Created.');
            return redirect()->back()->with('error', 'Failed, Customer has not been Created.');

        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $id = base64_decode($id);
        $customer = Customer::find($id);
        return view('admin.pages.customer.edit', compact('customer'));
    }

    /**
     * @param  Request  $req
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $req, $id) {
        $id = base64_decode($id);
        $customer = Customer::find($id);

        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->phone = $req->phone;
        $customer->address = $req->address;
        $customer->updated_by = Auth::user()->name;

        $update = $customer->update();

        if ($update) {
            getMessage('success', 'Success, Customer has been Updated.');
            return redirect()->route('customer.index')->with('success', 'Success, Customer has been Updated.');

        } else {
            getMessage('danger', 'Failed, Customer has not been Updated.');
            return redirect()->back()->with('error', 'Failed, Customer has not been Updated.');

        }

    }

    /**
     *
     */
    public function show($id) {
        $id = base64_decode($id);
        $customer = Customer::where('id', $id)->first();
        return $customer;

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        $id = base64_decode($id);
        $customer = Customer::find($id);
        $delete = $customer->delete();
        if ($delete) {
            getMessage('success', 'Success, Customer has been Deleted.');
            return redirect()->route('customer.index')->with('success', 'Success, Customer has been Deleted.');

        } else {
            getMessage('danger', 'Failed, Customer has not been Deleted.');
            return redirect()->back()->with('error', 'Failed, Customer has not been Deleted.');

        }
    }

    /**
     * Supplier Active/Inactive status process using ajax call by post...
     */
    public function status(Request $req) {
        if($req->ajax()) {
            $customer = Customer::where('id', $req->id)->first();
            $customer->status = $req->status;

            $customer->save();

        }

    }
}
