<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $categories = Category::latest()->get();
//        return $category;
        return view('admin.pages.category.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('admin.pages.category.create');
    }

    /**
     * @param  Request  $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $req) {
        $create = [
            'name' => $req->name,
            'slug' => Str::slug($req->name),
            'created_by' => Auth::user()->name,
        ];
        $category = Category::create($create);

        if($category) {
            getMessage('success', 'Success, Category has been Created.');
            return redirect()->route('category.index')->with('success', 'Success, Category has been Created.');
        } else {
            getMessage('danger', 'Failed, Category has not been Created.');
            return redirect()->back()->with('error', 'Failed, Category has not been Created.');

        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $id = base64_decode($id);
        $category = Category::find($id);
        return view('admin.pages.category.edit', compact('category'));
    }

    /**
     * @param  Request  $req
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $req, $id) {
        $id = base64_decode($id);
        $category = Category::find($id);

        $category->name = $req->name;
        $category->slug = Str::slug($req->name);
        $category->updated_by = Auth::user()->name;

        $update = $category->update();

        if ($update) {
            getMessage('success', 'Success, Category has been Updated.');
            return redirect()->route('category.index')->with('success', 'Success, Category has been Updated.');

        } else {
            getMessage('danger', 'Failed, Category has not been Updated.');
            return redirect()->back()->with('error', 'Failed, Category has not been Updated.');

        }

    }

    /**
     *
     */
    public function show($id) {
        $id = base64_decode($id);
        $category = Category::where('id', $id)->first();
        return $category;

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        $id = base64_decode($id);
        $category = Category::find($id);
        $delete = $category->delete();
        if ($delete) {
            getMessage('success', 'Success, Category has been Deleted.');
            return redirect()->route('category.index')->with('success', 'Success, Category has been Deleted.');

        } else {
            getMessage('danger', 'Failed, Category has not been Deleted.');
            return redirect()->back()->with('error', 'Failed, Category has not been Deleted.');

        }
    }

    /**
     * Unit Active/Inactive status process using ajax call by post...
     */
    public function status(Request $req) {
        if($req->ajax()) {
            $unit = Category::where('id', $req->id)->first();
            $unit->status = $req->status;

            $unit->save();

        }

    }
}
