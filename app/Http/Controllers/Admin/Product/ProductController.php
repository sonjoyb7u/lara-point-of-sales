<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $suppliers = Supplier::where('status', Supplier::ACTIVE_STATUS)->select('id', 'name')->latest()->get();
        $units = Unit::where('status', Unit::ACTIVE_STATUS)->select('id', 'name')->latest()->get();
        $categories = Category::where('status', Category::ACTIVE_STATUS)->select('id', 'name')->latest()->get();
        $sub_categories = SubCategory::where('status', SubCategory::ACTIVE_STATUS)->select('id',
            'name')->latest()->get();
        View::share([
            'suppliers' => $suppliers, 'units' => $units, 'categories' => $categories,
            'sub_categories' => $sub_categories
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('supplier', 'unit', 'category', 'sub_category')->where('status', Product::ACTIVE_STATUS)->latest()->get();
        return view('admin.pages.product.index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pages.product.create');
    }

    /**
     * @param  Request  $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $req)
    {
        $create = [
            'supplier_id' => $req->supplier_id,
            'unit_id' => $req->unit_id,
            'category_id' => $req->category_id,
            'sub_category_id' => $req->sub_category_id,
            'name' => $req->name,
            'slug' => Str::slug($req->name),
            'qty' => $req->qty,
            'created_by' => Auth::user()->name,
        ];
        $product = Product::create($create);

        if ($product) {
            getMessage('success', 'Success, Product has been Created.');
            return redirect()->route('product.index')->with('success', 'Success, Product has been Created.');
        } else {
            getMessage('danger', 'Failed, Product has not been Created.');
            return redirect()->back()->with('error', 'Failed, Product has not been Created.');

        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $product = Product::with('supplier', 'unit', 'category', 'sub_category')->where('status',
            Product::ACTIVE_STATUS)->find($id);
        return view('admin.pages.product.edit', compact('product'));
    }

    /**
     * @param  Request  $req
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $req, $id)
    {
        $id = base64_decode($id);
        $product = Product::find($id);

        $product->supplier_id = $req->supplier_id;
        $product->unit_id = $req->unit_id;
        $product->category_id = $req->category_id;
        $product->sub_category_id = $req->sub_category_id;
        $product->name = $req->name;
        $product->slug = Str::slug($req->name);
        $product->qty = $req->qty;
        $product->updated_by = Auth::user()->name;

        $update = $product->update();

        if ($update) {
            getMessage('success', 'Success, Product has been Updated.');
            return redirect()->route('product.index')->with('success', 'Success, Product has been Updated.');

        } else {
            getMessage('danger', 'Failed, Product has not been Updated.');
            return redirect()->back()->with('error', 'Failed, Product has not been Updated.');

        }

    }

    /**
     *
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $product = Product::where('id', $id)->first();
        return $product;

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $id = base64_decode($id);
        $product = Product::find($id);
        $delete = $product->delete();
        if ($delete) {
            getMessage('success', 'Success, Product has been Deleted.');
            return redirect()->route('product.index')->with('success', 'Success, Product has been Deleted.');

        } else {
            getMessage('danger', 'Failed, Product has not been Deleted.');
            return redirect()->back()->with('error', 'Failed, Product has not been Deleted.');

        }
    }

    /**
     * Unit Active/Inactive status process using ajax call by post...
     */
    public function status(Request $req)
    {
        if ($req->ajax()) {
            $product = Product::where('id', $req->id)->first();
            $product->status = $req->status;

            $product->save();

        }

    }
}
