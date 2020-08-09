<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class InvoiceController extends Controller
{

    /**
     * PurchaseController constructor.
     */
    public function __construct()
    {
        $categories = Category::where('status', Category::ACTIVE_STATUS)->select('id', 'name')->latest()->get();
        $customers = Customer::where('status', Customer::ACTIVE_STATUS)->select('id', 'name', 'phone', 'address')->latest()->get();
        View::share(['categories' => $categories, 'customers' => $customers]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $invoices = Invoice::with('payment')->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('admin.pages.invoice.index', compact('invoices'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $invoice_no = Invoice::orderBy('id', 'desc')->select('invoice_no')->first();
//        $current_date = date('Y-m-d h:m');
        if($invoice_no === null) {
            $invoice_no = 0;
            $new_invoice_no = $invoice_no + 1;
        } else {
            $invoice_no = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $new_invoice_no = $invoice_no + 1;
        }
        return view('admin.pages.invoice.create', compact('new_invoice_no', 'current_date'));
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

    /**
     * @param  Request  $req
     * @return \Illuminate\Http\JsonResponse
     */
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function productWiseStock(Request $req) {
        if($req->isMethod('POST')) {
            if($req->ajax()) {
                $product_id = $req->product_id;
                $product_qty = Product::where('id', $product_id)->first()->qty;
                return response()->json($product_qty);
            }
        }
    }

    public function store(Request $req)
    {
        if ($req->isMethod('POST')) {
            if ($req->category_id == null) {
                getMessage('danger', 'Sorry! You do not add any item to Invoice!');
                return redirect()->back()->with('error', 'Sorry! You do not add any item to Invoice!');
            } else {
                if($req->paid_amount > $req->total_price) {
                    getMessage('danger', 'Sorry, Paid amount is maximum between the Total amount!');
                    return redirect()->back()->with('error', 'Sorry, Paid amount is maximum between the Total amount!');
                } else {
                    $create = [
                        'invoice_no' => $req->invoice_no,
                        'date' => $req->date,
                        'desc' => $req->desc,
                        'created_by' => Auth::user()->name,
                    ];
//                    dd($create);
                    $invoice = Invoice::create($create);
                    if($invoice) {
                        $count_category = count($req->category_id);
                        for($i = 0; $i < $count_category; $i++) {
                            $create = [
                                'invoice_id' => $invoice->id,
                                'category_id' => $req->category_id[$i],
                                'sub_category_id' => $req->sub_category_id[$i],
                                'product_id' => $req->product_id[$i],
                                'date' => $req->date,
                                'selling_qty' => $req->selling_qty[$i],
                                'unit_price' => $req->unit_price[$i],
                                'selling_price' => $req->selling_price[$i],
                            ];
                            $invoice_detail = InvoiceDetail::create($create);
                        }
                        if($invoice_detail) {
                            if($req->customer_id === '0') {
                                $create = [
                                    'name' => $req->name,
                                    'email' => $req->email,
                                    'phone' => $req->phone,
                                    'address' => $req->address,
                                    'created_by' => Auth::user()->name,
                                ];
                                $customer = Customer::create($create);
                                $customer_id = $customer->id;
                            } else {
                                $customer_id = $req->customer_id;
                            }

                            if($req->paid_status === 'paid') {
                                $create_payment = [
                                    'invoice_id' => $invoice->id,
                                    'customer_id' => $customer_id,
                                    'paid_status' => $req->paid_status,
                                    'paid_amount' => $req->total_price,
                                    'due_amount' => 0.00,
                                    'total_amount' => $req->total_price,
                                    'discount_amount' => $req->discount_amount,
                                ];
                                $payment = Payment::create($create_payment);
                                if($payment) {
                                    $create_payment_detail = [
                                        'invoice_id' => $invoice->id,
                                        'date' => $req->date,
                                        'current_paid_amount' => $req->total_price,
                                    ];
                                    $payment_detail = PaymentDetail::create($create_payment_detail);
                                    if($payment_detail) {
                                        getMessage('success', 'Success, Product items has been saled with full paid.');
                                        return redirect()->route('invoice.index')->with('success', 'Success, Product items has been saled with full paid.');
                                    } else {
                                        getMessage('danger', 'Sorry, Something went wrong of Payment details!');
                                        return redirect()->back()->with('error', 'Sorry, Something went wrong of Payment details!');
                                    }
                                }

                            } elseif($req->paid_status === 'due') {
                                $create_payment = [
                                    'invoice_id' => $invoice->id,
                                    'customer_id' => $customer_id,
                                    'paid_status' => $req->paid_status,
                                    'paid_amount' => 0.00,
                                    'due_amount' => $req->total_price,
                                    'total_amount' => $req->total_price,
                                    'discount_amount' => $req->discount_amount,
                                ];
                                $payment = Payment::create($create_payment);
                                if($payment) {
                                    $create_payment_detail = [
                                        'invoice_id' => $invoice->id,
                                        'date' => $req->date,
                                        'current_paid_amount' => 0.00,
                                    ];
                                    $payment_detail = PaymentDetail::create($create_payment_detail);
                                    if($payment_detail) {
                                        getMessage('success', 'Success, Product items has been saled with full due.');
                                        return redirect()->route('invoice.index')->with('success', 'Success, Product items has been saled with full due.');
                                    } else {
                                        getMessage('danger', 'Sorry, Something went wrong of Payment details!');
                                        return redirect()->back()->with('error', 'Sorry, Something went wrong of Payment details!');
                                    }
                                }
                            } elseif($req->paid_status === 'partial') {
                                $create_payment = [
                                    'invoice_id' => $invoice->id,
                                    'customer_id' => $customer_id,
                                    'paid_status' => $req->paid_status,
                                    'paid_amount' => $req->paid_amount,
                                    'due_amount' => $req->total_price - $req->paid_amount,
                                    'total_amount' => $req->total_price,
                                    'discount_amount' => $req->discount_amount,
                                ];
                                $payment = Payment::create($create_payment);
                                if($payment) {
                                    $create_payment_detail = [
                                        'invoice_id' => $invoice->id,
                                        'date' => $req->date,
                                        'current_paid_amount' => $req->paid_amount,
                                    ];
                                    $payment_detail = PaymentDetail::create($create_payment_detail);
                                    if($payment_detail) {
                                        getMessage('success', 'Success, Product items has been saled with some paid & some due.');
                                        return redirect()->route('invoice.index')->with('success', 'Success, Product items has been saled with some paid & some due.');
                                    } else {
                                        getMessage('danger', 'Sorry, Something went wrong of Payment details!');
                                        return redirect()->back()->with('error', 'Sorry, Something went wrong of Payment details!');
                                    }
                                }
                            }


                        } else {
                            getMessage('danger', 'Sorry, Something went wrong of Invoice details!');
                            return redirect()->back()->with('error', 'Sorry, Something went wrong of Invoice details!');
                        }

                    } else {
                        getMessage('danger', 'Sorry, Something went wrong of Invoice!');
                        return redirect()->back()->with('error', 'Sorry, Something went wrong of Invoice!');
                    }
                }

            }

            getMessage('success', 'Success, Product has been saled.');
            return redirect()->route('invoice.index')->with('success', 'Success, Product has been saled.');

        }
    }

    /**
     *
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $invoice = Invoice::where('id', $id)->first();
        return $invoice;

    }

    /**
     * @param  Request  $req
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoiceApprove(Request $req, $id)
    {
        if($req->isMethod('GET')) {
            $id = base64_decode($id);
            $invoice = Invoice::with('payment')->where('id', $id)->first();
            return view('admin.pages.invoice.invoice-approve', compact('invoice'));

        }

    }

    /**
     * @param  Request  $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadInvoiceApproveDetail(Request $req) {
        if($req->isMethod('POST')) {
            if($req->ajax()) {
                $invoice = Invoice::with('payment', 'invoice_details')->where('id', $req->invoice_id)->first();
                return view('admin.pages.invoice.load-invoice-approve-detail', compact('invoice'));
            }
        }
    }

    public function invoiceApproveCreate(Request $req, $invoice_id) {
        if($req->isMethod('POST')) {
            foreach ($req->invoice_detail_id as $id) {
                $invoice_detail = InvoiceDetail::where('id', $id)->first();
                $product = Product::where('id', $invoice_detail->product_id)->first();
                if($product->qty < $invoice_detail->selling_qty) {
                    getMessage('danger', 'Sorry, This product - ( '.$product->name.' ) is out of stock!');
                    return redirect()->back()->with('error', 'Sorry, This product - ( ' . $product->name . ' ) is out of stock!');
                }
            }
            $invoice_id = base64_decode($invoice_id);
            $invoice = Invoice::find($invoice_id);
            if($invoice->count() > 0) {
                $invoice->status = 'approved';
                $invoice->updated_by = Auth::user()->name;
                foreach ($req->invoice_detail_id as $id) {
                    $invoice_detail = InvoiceDetail::where('id', $id)->first();
                    $product = Product::where('id', $invoice_detail->product_id)->first();
                    $product->qty = ((float)$product->qty) - ((float)$invoice_detail->selling_qty);
                    $product->save();
                }
                $invoice->save();
            }
            getMessage('success', 'Invoice has been succesfully approved.');
            return redirect()->route('invoice.index')->with('success', 'Invoice has been succesfully approved.');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $id = base64_decode($id);
        $invoice = Invoice::find($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        $delete = PaymentDetail::where('invoice_id', $invoice->id)->delete();

        if ($delete) {
            getMessage('success', 'Success, Invoice relation all data has been Deleted.');
            return redirect()->route('invoice.index')->with('success', 'Success, Invoice relation all data has been Deleted.');

        } else {
            getMessage('danger', 'Failed, Invoice relation all data has not been Deleted.');
            return redirect()->back()->with('error', 'Failed, Invoice relation all data has not been Deleted.');

        }
    }

    /**
     * @param $invoice_id
     * @return mixed
     */
    public function invoicePrint($invoice_id) {
        $invoice = Invoice::with('payment', 'invoice_details')->where('id', $invoice_id)->first();
        $pdf = PDF::loadView('admin.pages.pdf-files.invoice', compact('invoice'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

    }

    public function invoiceReportDaily() {
        return view('admin.pages.invoice.daily-invoice-report');
    }

    public function invoiceReportDailyPdf(Request $req) {
        if($req->isMethod('POST')) {
            if($req->ajax()) {
                $start_date = $req->start_date;
                $end_date = $req->end_date;
                $invoices = Invoice::with('payment', 'invoice_details')
                                    ->whereBetween('date', [$start_date, $end_date])
                                    ->where('status', Invoice::APPROVED_STATUS)->get();
                if($invoices->count() > 0) {
//                dd($invoice);
                    return view('admin.pages.invoice.load-invoice-report-daily', compact('invoices', 'start_date', 'end_date'));
                } else {
                    return "Sorry, Date wise invoice report not found!";
                }

            }
        }
    }

    public function invoiceDailyReportPdfPrint(Request $req) {
        $invoice_id = base64_decode($req->invoice_id);
        $start_date = $req->start_date;
        $end_date = $req->end_date;
        $invoices = Invoice::with('payment', 'invoice_details')->where('id', $invoice_id)->get();
        $pdf = PDF::loadView('admin.pages.pdf-files.daily-invoice-report-pdf', compact('invoices', 'start_date', 'end_date'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}
