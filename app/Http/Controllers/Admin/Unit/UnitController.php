<?php

namespace App\Http\Controllers\Admin\Unit;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $units = Unit::latest()->get();
//        return $customers;
        return view('admin.pages.unit.index', compact('units'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('admin.pages.unit.create');
    }

    /**
     * @param  Request  $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $req) {
        $create = [
            'name' => $req->name,
            'created_by' => Auth::user()->name,
        ];
        $unit = Unit::create($create);

        if($unit) {
            getMessage('success', 'Success, Unit has been Created.');
            return redirect()->route('unit.index')->with('success', 'Success, Unit has been Created.');
        } else {
            getMessage('danger', 'Failed, Unit has not been Created.');
            return redirect()->back()->with('error', 'Failed, Unit has not been Created.');

        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $id = base64_decode($id);
        $unit = Unit::find($id);
        return view('admin.pages.unit.edit', compact('unit'));
    }

    /**
     * @param  Request  $req
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $req, $id) {
        $id = base64_decode($id);
        $unit = Unit::find($id);

        $unit->name = $req->name;
        $unit->updated_by = Auth::user()->name;

        $update = $unit->update();

        if ($update) {
            getMessage('success', 'Success, Unit has been Updated.');
            return redirect()->route('unit.index')->with('success', 'Success, Unit has been Updated.');

        } else {
            getMessage('danger', 'Failed, Unit has not been Updated.');
            return redirect()->back()->with('error', 'Failed, Unit has not been Updated.');

        }

    }

    /**
     *
     */
    public function show($id) {
        $id = base64_decode($id);
        $unit = Unit::where('id', $id)->first();
        return $unit;

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        $id = base64_decode($id);
        $unit = Unit::find($id);
        $delete = $unit->delete();
        if ($delete) {
            getMessage('success', 'Success, Unit has been Deleted.');
            return redirect()->route('unit.index')->with('success', 'Success, Unit has been Deleted.');

        } else {
            getMessage('danger', 'Failed, Unit has not been Deleted.');
            return redirect()->back()->with('error', 'Failed, Unit has not been Deleted.');

        }
    }

    /**
     * Unit Active/Inactive status process using ajax call by post...
     */
    public function status(Request $req) {
        if($req->ajax()) {
            $unit = Unit::where('id', $req->id)->first();
            $unit->status = $req->status;

            $unit->save();

        }

    }
}
