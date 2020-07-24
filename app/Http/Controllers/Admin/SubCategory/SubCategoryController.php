<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $sub_categories = SubCategory::where('status', SubCategory::ACTIVE_STATUS)->latest()->get();
//        return $sub_categories;
        return view('admin.pages.sub-category.index', compact('sub_categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $categories = Category::where('status', Category::ACTIVE_STATUS)->select('id', 'name')->latest()->get();
        return view('admin.pages.sub-category.create', compact('categories'));
    }

    /**
     * @param  Request  $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $req) {
        $create = [
            'category_id' => $req->category_id,
            'name' => $req->name,
            'slug' => Str::slug($req->name),
            'created_by' => Auth::user()->name,
        ];
        $sub_category = SubCategory::create($create);

        if($sub_category) {
            getMessage('success', 'Success, Sub Category has been Created.');
            return redirect()->route('sub-category.index')->with('success', 'Success, Sub Category has been Created.');
        } else {
            getMessage('danger', 'Failed, Sub Category has not been Created.');
            return redirect()->back()->with('error', 'Failed, Sub Category has not been Created.');

        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $id = base64_decode($id);
        $categories = Category::where('status', Category::ACTIVE_STATUS)->select('id', 'name')->latest()->get();
        $sub_category = SubCategory::with('category')->find($id);
        return view('admin.pages.sub-category.edit', compact('sub_category', 'categories'));
    }

    /**
     * @param  Request  $req
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $req, $id) {
        $id = base64_decode($id);
        $sub_category = SubCategory::where('status', SubCategory::ACTIVE_STATUS)->find($id);

        $sub_category->category_id = $req->category_id;
        $sub_category->name = $req->name;
        $sub_category->slug = Str::slug($req->name);
        $sub_category->updated_by = Auth::user()->name;

        $update = $sub_category->update();

        if ($update) {
            getMessage('success', 'Success, Sub Category has been Updated.');
            return redirect()->route('sub-category.index')->with('success', 'Success, Sub Category has been Updated.');

        } else {
            getMessage('danger', 'Failed, Sub Category has not been Updated.');
            return redirect()->back()->with('error', 'Failed, Sub Category has not been Updated.');

        }

    }

    /**
     *
     */
    public function show($id) {
        $id = base64_decode($id);
        $sub_category = SubCategory::where('status', SubCategory::ACTIVE_STATUS)->where('id', $id)->first();
        return $sub_category;

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        $id = base64_decode($id);
        $sub_category = SubCategory::find($id);
        $delete = $sub_category->delete();
        if ($delete) {
            getMessage('success', 'Success, Sub Category has been Deleted.');
            return redirect()->route('sub-category.index')->with('success', 'Success, Sub Category has been Deleted.');

        } else {
            getMessage('danger', 'Failed, Sub Category has not been Deleted.');
            return redirect()->back()->with('error', 'Failed, Sub Category has not been Deleted.');

        }
    }

    /**
     * Sub Category Active/Inactive status process using ajax call by post...
     */
    public function status(Request $req) {
        if($req->ajax()) {
            $sub_category = SubCategory::where('id', $req->id)->first();
            $sub_category->status = $req->status;

            $sub_category->save();

        }

    }
}
