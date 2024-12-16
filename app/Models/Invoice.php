<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PDF;

class Invoice extends Model
{
    use SoftDeletes;

    public static function getSubTotalAmount($unit_price,$quantity) {
        $subtotal = 0;
        if(isset($unit_price) && isset($quantity)) {
            foreach ($unit_price as $key => $price) {
                $single_price = $quantity[$key] * $price;
                $subtotal += $single_price;
            }
        }
        return $subtotal;
    }

    public static function saveInvoice($id) {
        $generateDate = Carbon::now();
        $invoice = Invoice::findOrFail($id);
        //return view('admin.invoice.invoice_pdf',compact('invoice','generateDate'));
        $pdf = PDF::loadView('admin.invoice.invoice_pdf',compact('invoice','generateDate'));
        $invoice_name = 'invoice_'.$invoice->invoice_no;
        //$pdf->stream('assets/files/'.$invoice_name.'.pdf');
        $pdf->save('assets/files/invoice/'.$invoice_name.'.pdf');
        $invoice->invoice_pdf = 'assets/files/invoice/'.$invoice_name.'.pdf';
        $invoice->save();
        //return $invoice->invoice_pdf;
    }

    public function invoice_data() {
        return $this->hasMany(InvoiceData::class,'invoice_id','id');
    }

    
}
