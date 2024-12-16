<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InvoiceData;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Invoice::query();
        $invoices = $data->paginate(20);
        return view('admin.invoice.invoice_list',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Add New Invoice";
        $products = Product::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();
        $route = route('admin.invoices.store');
        $invoice_no = str_pad(Invoice::count() + 1, 3, '0', STR_PAD_LEFT);
        return view('admin.invoice.invoice_add_edit',compact('page_title','products','route','invoice_no','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = new Invoice();
        $invoice->invoice_no = $request->invoice_no;
        $invoice->invoice_date = $request->invoice_date ?? Carbon::today();
        // Set common variables
        $sub_total = Invoice::getSubTotalAmount($request->unit_price,$request->quantity);
        $tax = $request->tax ?? 0;
        $grand_total = $sub_total  + $tax;
        $invoice->sub_total = $sub_total;
        $invoice->tax = $tax;
        $invoice->grand_total = $grand_total;
        $invoice->additional_note = $request->additional_note ?? Null;
        $invoice->payment_status = $request->payment_status ?? "Unpaid";
        $invoice->invoice_to = $request->invoice_to;

        // if($request->invoice_to) {
        //     $emails = implode(', ',$request->invoice_to);
        //     $invoice->invoice_to = $emails;
        // }

        $invoice->created_by = Auth::id();
        $invoice->save();
        if($request->product_id) {
            foreach ($request->product_id as $key=> $product){
                $identify = ['invoice_id' => $invoice->id,'product_id' => $product];
                $data['invoice_id'] = $invoice->id;
                $data['product_id'] = $request->product_id[$key];
                $data['item_name'] = $request->product_name[$key];
                $data['item_details'] = $request->description[$key];
                $data['unit_price'] = $request->unit_price[$key];
                $data['quantity'] = $request->quantity[$key];
                $data['total_price'] = $request->unit_price[$key] * $request->quantity[$key];
                $data['created_at'] = Carbon::now();
                InvoiceData::updateOrInsert($identify,$data);
            }
        }
        $new_invoice = Invoice::findOrFail($invoice->id);
        Invoice::saveInvoice($new_invoice->id);
        // Send invoice to client
//        $email = $new_invoice->client_info->email;
//        $mail = [
//           'name'=> $site_setting->title,
//           'invoice_id' => $new_invoice->id,
//        ];
//        Mail::to($email)->send(new SendInvoice($mail));
        return redirect()->route('admin.invoices.index')->with(savedMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($invoice_no)
    {
        $data = Invoice::where('invoice_no',$invoice_no)->firstOrFail();
        return view('admin.invoice.invoice_details',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice_data = $invoice->invoice_data;
        $route = route('admin.invoices.update',$id);
        $page_title = "Eidt Invoice - ".$invoice->invoice_no;
        $products = Product::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();
        return view('admin.invoice.invoice_add_edit',compact('invoice','invoice_data','route','page_title','products','clients'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->invoice_no = $request->invoice_no;
        $invoice->invoice_date = $request->invoice_date ?? Carbon::today();
        // Set common variables
        $sub_total = Invoice::getSubTotalAmount($request->unit_price,$request->quantity);
        $tax = $request->tax ?? 0;
        $grand_total = $sub_total  + $tax;
        $invoice->sub_total = $sub_total;
        $invoice->tax = $tax;
        $invoice->grand_total = $grand_total;
        $invoice->additional_note = $request->additional_note ?? Null;
        $invoice->payment_status = $request->payment_status ?? "Unpaid";
        $invoice->invoice_to = $request->invoice_to;

        // if($request->invoice_to) {
        //     $emails = implode(', ',$request->invoice_to);
        //     $invoice->invoice_to = $emails;
        // }

        $invoice->created_by = Auth::id();
        $invoice->save();
        if($request->product_id) {
            foreach ($request->product_id as $key=> $product){
                $identify = ['invoice_id' => $invoice->id,'product_id' => $product];
                $data['invoice_id'] = $invoice->id;
                $data['product_id'] = $request->product_id[$key];
                $data['item_name'] = $request->product_name[$key];
                $data['item_details'] = $request->description[$key];
                $data['unit_price'] = $request->unit_price[$key];
                $data['quantity'] = $request->quantity[$key];
                $data['total_price'] = $request->unit_price[$key] * $request->quantity[$key];
                $data['created_at'] = Carbon::now();
                InvoiceData::updateOrInsert($identify,$data);
            }
        }
        $new_invoice = Invoice::findOrFail($invoice->id);
        Invoice::saveInvoice($new_invoice->id);
        // Send invoice to client
//        $email = $new_invoice->client_info->email;
//        $mail = [
//           'name'=> $site_setting->title,
//           'invoice_id' => $new_invoice->id,
//        ];
//        Mail::to($email)->send(new SendInvoice($mail));
        return redirect()->route('admin.invoices.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
