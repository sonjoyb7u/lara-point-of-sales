<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $suppliers = Supplier::where('status', Supplier::ACTIVE_STATUS)->select('id', 'name')->latest()->get();
        $units = Unit::where('status', Unit::ACTIVE_STATUS)->select('id', 'name')->latest()->get();
        $categories = Category::where('status', Category::ACTIVE_STATUS)->select('id', 'name')->latest()->get();
        $sub_categories = SubCategory::where('status', SubCategory::ACTIVE_STATUS)->select('id',
            'name')->latest()->get();
        $products = Product::with('supplier')->where('status', Product::ACTIVE_STATUS)->select('supplier_id')->groupBy('supplier_id')->get();
//        dd($products);
//        $product_collection = collect($products);
//        $unique_suppliers = $product_collection->unique('supplier_id');
        View::share([
            'suppliers' => $suppliers, 'units' => $units, 'categories' => $categories,
            'sub_categories' => $sub_categories, 'products' => $products]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $purchases = Purchase::with('supplier', 'unit', 'category', 'sub_category', 'product')->orderBy('purchase_date', 'desc')->orderBy('id', 'desc')->get();
        return view('admin.pages.purchase.index', compact('purchases'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pages.purchase.create');
    }

    /**
     * @param  Request  $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function supplierWiseCategory(Request $req) {
        if($req->isMethod('POST')) {
            if($req->ajax()) {
                $supplier_id = $req->supplier_id;
                $categories = Product::with('category')->where('supplier_id', $supplier_id)->select('category_id')->groupBy('category_id')->get();
                return response()->json($categories);
            }
        }
    }

    /**
     * @param  Request  $req
     * @return array
     */
    public function categoryWiseSubCategory(Request $req) {
        if($req->isMethod('POST')) {
            if($req->ajax()) {
                $category_id = $req->category_id;
                $sub_categories = Product::with('sub_category')->where('category_id', $category_id)->select('sub_category_id')->groupBy('sub_category_id')->get();
//                dd($sub_categories);
                return response()->json($sub_categories);


            }
        }
    }

    /**
     * @param  Request  $req
     * @return array
     */
    public function categoryWiseUnit(Request $req) {
        if($req->isMethod('POST')) {
            if($req->ajax()) {
                $category_id = $req->category_id;
                $units = Product::with('unit')->where('category_id', $category_id)->select('unit_id')->groupBy('unit_id')->get();
                return response()->json($units);
            }
        }
    }

    public function categoryWiseProduct(Request $req) {
        if($req->isMethod('POST')) {
            if($req->ajax()) {
                $category_id = $req->category_id;
                $products = Product::where('category_id', $category_id)->select('id', 'name', 'slug')->get();
                return response()->json($products);
            }
        }
    }

    /**
     * @param  Request  $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $req)
    {
        if($req->isMethod('POST')) {
            if($req->category_id == null) {
                getMessage('danger', 'Sorry! You do not add any item to purchase!');
                return redirect()->back()->with('error', 'Sorry! You do not add any item to purchase!');
            } else {
                $count_category = count($req->category_id);
                for($i = 0; $i < $count_category; $i++) {
//                    $product = Product::where('id', $req->product_id[$i])->first();
//                    if($product->qty >= $req->buying_qty[$i]) {
//                        return "True";
                        $create = [
                            'supplier_id' => $req->supplier_id[$i],
                            'unit_id' => $req->unit_id[$i],
                            'category_id' => $req->category_id[$i],
                            'sub_category_id' => $req->sub_category_id[$i],
                            'product_id' => $req->product_id[$i],
                            'purchase_no' => $req->purchase_no[$i],
                            'purchase_date' => $req->purchase_date[$i],
                            'desc' => $req->desc[$i],
                            'unit_price' => $req->unit_price[$i],
                            'buying_qty' => $req->buying_qty[$i],
                            'buying_price' => $req->buying_price[$i],
                            'purchase_status' => 'pending',
                            'created_by' => Auth::user()->name,
                        ];
//                    return $create;
                        $purchase = Purchase::create($create);

//                    } else {
////                        return "False";
//                        getMessage('danger', 'Sorry! This product is stock limit!');
//                        return redirect()->back()->with('error', 'Sorry! This product item is stock limit!');
//                    }

                }
            }
            if ($purchase) {
                getMessage('success', 'Success, Product has been Purchased.');
                return redirect()->route('purchase.index')->with('success', 'Success, Product has been Purchased.');
            } else {
                getMessage('danger', 'Failed, Product has not been Purchased!');
                return redirect()->back()->with('error', 'Failed, Product has not been Purchased!');

            }

        }

    }

    /**
     * @param  Request  $req
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
//    public function checkProductStock(Request $req, $product_id) {
//        if($req->isMethod('GET')) {
//            if($req->ajax()) {
//                $product = Product::where('id', $product_id)->select('qty')->first();
//                if($product->qty <= 1) {
//                    return response()->json($product);
//                } else {
//                    return response()->json($product);
//                }
//            }
//        }
//    }
//

    /**
     * @param  Request  $req
     * @return \Illuminate\Http\JsonResponse
     */
//    public function checkProductListStock(Request $req) {
//        if($req->isMethod('POST')) {
//            if($req->ajax()) {
//                $product = Product::where('id', $req->product_id)->select('qty')->first();
//                $product_stock = $product->qty;
//                $buyQty = $req->quantity;
//                if($product_stock < $buyQty) {
//                    return response()->json($product_stock);
//                }
//                else {
//                    return response()->json($product_stock);
//                }
//            }
//        }
//    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
//    public function edit($id)
//    {
//        $id = base64_decode($id);
//        $purchase = Purchase::with('supplier', 'unit', 'category', 'sub_category')->find($id);
//        return view('admin.pages.purchase.edit', compact('purchase'));
//    }

    /**
     * @param  Request  $req
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
//    public function update(Request $req, $id)
//    {
//        $id = base64_decode($id);
//        $purchase = Purchase::find($id);
//
//        $purchase->supplier_id = $req->supplier_id;
//        $purchase->unit_id = $req->unit_id;
//        $purchase->category_id = $req->category_id;
//        $purchase->sub_category_id = $req->sub_category_id;
//        $purchase->sub_category_id = $req->sub_category_id;
//        $purchase->name = $req->name;
//        $purchase->slug = Str::slug($req->name);
//        $purchase->qty = $req->qty;
//        $purchase->updated_by = Auth::user()->name;
//
//        $update = $purchase->update();
//
//        if ($update) {
//            getMessage('success', 'Success, Product has been Updated.');
//            return redirect()->route('product.index')->with('success', 'Success, Product has been Updated.');
//
//        } else {
//            getMessage('danger', 'Failed, Product has not been Updated.');
//            return redirect()->back()->with('error', 'Failed, Product has not been Updated.');
//
//        }
//
//    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $product = Purchase::where('id', $id)->first();
        return $product;

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $id = base64_decode($id);
        $purchase = Purchase::findorFail($id);
        Product::where('id', $purchase->product_id)->decrement('qty', $purchase->buying_qty);
        $delete = $purchase->delete();
        if ($delete) {
            getMessage('success', 'Success, Product purchase has been Deleted with product stock.');
            return redirect()->route('purchase.index')->with('success', 'Success, Product purchase has been Deleted with product stock.');

        } else {
            getMessage('danger', 'Failed, Product purchase has not been Deleted with product stock.');
            return redirect()->back()->with('error', 'Failed, Product purchase has not been Deleted with product stock.');

        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageStatus()
    {
        $purchases = Purchase::with('supplier', 'unit', 'category', 'sub_category', 'product')
                                ->where('purchase_status', Purchase::PENDING_STATUS)
                                ->orWhere('purchase_status', Purchase::RETURN_STATUS)
                                ->orderBy('purchase_date', 'desc')
                                ->orderBy('id', 'desc')
                                ->get();
        return view('admin.pages.purchase.manage-status', compact('purchases'));
    }

    /**
     * @param  Request  $req
     * @param $id
     * @return bool|string
     */
    public function approvedStatus($id) {
        $id = base64_decode($id);
        $purchase = Purchase::with('product')->findorFail($id);
        if($purchase->product->status === Product::ACTIVE_STATUS) {
            $purchase->purchase_status = 'approved';
            Product::where('id', $purchase->product_id)->increment('qty', $purchase->buying_qty);
            $update = $purchase->update();
            if($update) {
                getMessage('success', 'Success, Purchase has been approved.');
                return redirect()->route('purchase.index')->with('success', 'Success, Purchase has been approved.');
            } else {
                getMessage('danger', 'Failed, Somethig went wrong!');
                return redirect()->back()->with('error', 'Failed, Somethig went wrong!');
            }
        } else {
            getMessage('danger', 'Failed, Purchase has not been approved because product status inactive!');
            return redirect()->route('purchase.index')->with('error', 'Failed, Purchase has not been approved because product status inactive!');
        }

    }

    /**
     * @param  Request  $req
     * @param $id
     * @return bool|string
     */
    public function pendingStatus($id) {
        $id = base64_decode($id);
        $purchase = Purchase::findorFail($id);
        if($purchase->purchase_status === 'approved') {
            $purchase->purchase_status = 'pending';
            Product::where('id', $purchase->product_id)->decrement('qty', $purchase->buying_qty);
        } elseif($purchase->purchase_status === 'return') {
            $purchase->purchase_status = 'pending';
        }


        $update = $purchase->update();
        if($update) {
            getMessage('success', 'Success, Purchase has been pending.');
            return redirect()->route('purchase.index')->with('success', 'Success, Purchase has been pending.');
        } else {
            getMessage('danger', 'Failed, Somethig went wrong!');
            return redirect()->back()->with('error', 'Failed, Somethig went wrong!');
        }
    }

    public function returnStatus($id) {
        $id = base64_decode($id);
        $purchase = Purchase::findorFail($id);
        if($purchase->purchase_status === 'approved') {
            $purchase->purchase_status = 'return';
            Product::where('id', $purchase->product_id)->decrement('qty', $purchase->buying_qty);
        } elseif($purchase->purchase_status === 'pending') {
            $purchase->purchase_status = 'return';
        }


        $update = $purchase->update();
        if($update) {
            getMessage('success', 'Success, Purchase has been returned.');
            return redirect()->route('purchase.index')->with('success', 'Success, Purchase has been returned.');
        } else {
            getMessage('danger', 'Failed, Somethig went wrong!');
            return redirect()->back()->with('error', 'Failed, Somethig went wrong!');
        }
    }
}
