<?php

namespace App\Http\Controllers\Admin\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * 
     */
    public function index() {
        $suppliers = Supplier::latest()->get();
        return view('admin.pages.supplier.index', compact('suppliers'));
    }

    /**
     * 
     */
    public function create() {
        return view('admin.pages.supplier.create');
    }

    /**
     * 
     */
    public function store(Request $req) {
        $create = [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'created_by' => Auth::user()->name,
        ];
        $supplier = Supplier::create($create);

        if($supplier) {
            getMessage('success', 'Success, Supplier has been Created.');
            return redirect()->route('supplier.index')->with('success', 'Success, Supplier has been Created.');
        } else {
            getMessage('danger', 'Failed, Supplier has not been Created.');
            return redirect()->back()->with('error', 'Failed, Supplier has not been Created.');

        }
    }

    /**
     * 
     */
    public function edit($id) {
        $id = base64_decode($id);
        $supplier = Supplier::find($id);
        return view('admin.pages.supplier.edit', compact('supplier'));
    }

    public function update(Request $req, $id) {
        $id = base64_decode($id);
        $supplier = Supplier::find($id);

        $supplier->name = $req->name;
        $supplier->email = $req->email;
        $supplier->phone = $req->phone;
        $supplier->address = $req->address;
        $supplier->updated_by = Auth::user()->name;

        $update = $supplier->update();

        if ($update) {
            getMessage('success', 'Success, Supplier has been Updated.');
            return redirect()->route('supplier.index')->with('success', 'Success, Supplier has been Updated.');

        } else {
            getMessage('danger', 'Failed, Supplier has not been Updated.');
            return redirect()->back()->with('error', 'Failed, Supplier has not been Updated.');

        }

    }

    /**
     * 
     */
    public function show($id) {
        $id = base64_decode($id);
        $supplier = Supplier::where('id', $id)->first();
        return $supplier;

    }

    public function destroy($id) {
        $id = base64_decode($id);
        $supplier = Supplier::find($id);
        $delete = $supplier->delete();
        if ($delete) {
            getMessage('success', 'Success, Supplier has been Deleted.');
            return redirect()->route('supplier.index')->with('success', 'Success, Supplier has been Deleted.');

        } else {
            getMessage('danger', 'Failed, Supplier has not been Deleted.');
            return redirect()->back()->with('error', 'Failed, Supplier has not been Deleted.');

        }
    }

    /**
     * Supplier Active/Inactive status process using ajax call by post...
     */
    public function status(Request $req) {
        if($req->ajax()) {
           $supplier = Supplier::where('id', $req->id)->first();
           $supplier->status = $req->status;

           $supplier->save();

        }

    }

}
