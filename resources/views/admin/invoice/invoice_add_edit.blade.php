@extends('admin.layouts.app')
@section('title', $page_title ?? 'Invoice')
@push('css')
@endpush

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ $page_title ?? 'Invoice' }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ $route }}" method="post" id="invoice_add" class="needs-validation"
                                novalidate>
                                @csrf
                                @isset($invoice)
                                    @method('PUT')
                                @endisset
                                <input type="hidden" name="submit_mode" value="{{ isset($invoice) ? 'edit' : 'add' }}" id="submit_mode">
                                <div class="row">
                                    <div class="col-sm-12 mb-2 col-md-3">
                                        <div class="form-group">
                                            <label>Invoice No.</label>{!! starSign() !!}
                                            <input type="text" name="invoice_no" id="invoice_no"
                                                value="{{ $invoice_no ?? ($invoice->invoice_no ?? '') }}" class="form-control"
                                                placeholder="Invoice No." required readonly>
                                        </div>
                                        @error('invoice_no')
                                            {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-2 col-md-3">
                                        <div class="form-group">
                                            <label>Invoice Date</label>{!! starSign() !!}
                                            <input type="text" name="invoice_date" id="invoice_date"
                                                value="{{ $invoice->invoice_date ?? \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                class="form-control customDatepicker" placeholder="Invoice Date"
                                                autocomplete="off" readonly >
                                        </div>
                                        @error('invoice_date')
                                            {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-2 col-md-3">
                                        <div class="form-group">
                                            <label>Invoice To</label></label>
                                            <select name="invoice_to" id="invoice_to" class="form-control select2"
                                                data-placeholder="Select Client">
                                                <option value="">Select Email</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->email }}"
                                                        {{ isset($invoice) && $invoice->invoice_to == $client->email ? 'selected' : '' }}>
                                                        {{ $client->name ?? '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('invoice_to')
                                            {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-2 col-md-3">
                                        <div class="form-group">
                                            <label>Product</label>
                                            <select name="product_id" id="product_id" class="form-control select2">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-id="{{ $product->id }}">
                                                        {{ $product->name ?? '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('product_id')
                                            {!! displayError($message) !!}
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table" id="invoice_table">
                                                <thead>
                                                    <tr>
                                                        <th>Sn</th>
                                                        <th>Product/Item</th>
                                                        <th>Unit Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($invoice_data) && count($invoice_data))
                                                    @foreach($invoice_data as $data)
                                                        <tr id="row_{{ $data->product_id }}">
                                                            <td class="serial">{{ $loop->index + 1 }}</td>
                                                            <td class="col-5">
                                                                <input type="hidden" name="product_id[]"
                                                                    value="{{ $data->product_id }}"
                                                                    class="form-control product_id">
                                                                <input type="text" name="product_name[]"
                                                                    value="{{ $data->product->name ?? '' }}" class="form-control"
                                                                    readonly required>
                                                                <br>
                                                                <textarea placeholder="Description" name="description[]" class="form-control" required rows="1"
                                                                    placeholder="Short Description">{{ $data->item_details ?? '' }}</textarea>
                                                            </td>
                                                            <td class="col-2">
                                                                <input type="text" name="unit_price[]"
                                                                    value="{{ $data->unit_price ?? 0 }}"
                                                                    class="form-control unit_price"
                                                                    placeholder="Unit Price" required>
                                                            </td>
                                                            <td class="col-2">
                                                                <input type="text" name="quantity[]" value="{{ $data->quantity }}"
                                                                    class="form-control quantity" placeholder="Quantity" required min="1" >
                                                            </td>
                                                            <td class="col-2">
                                                                <input type="text" name="amount[]"
                                                                    value="{{ $data->total_price ?? 0 }}"
                                                                    class="form-control amount" readonly
                                                                    placeholder="Total" required>
                                                            </td>
                                                            <td class="col-1">
                                                                <button type="button"
                                                                    class="btn btn-md btn-danger ds_remove_row"
                                                                    data-id="{{ $data->product_id }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Sub Total</th>
                                                    <th>Tax</th>
                                                    <th>Grand Total</th>
                                                    <th>Payment Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-3">
                                                        <input type="text" value="{{ $invoice->sub_total ?? 0 }}" name="sub_total"
                                                            class="form-control sub_total" readonly>
                                                    </td>
                                                    <td class="col-3">
                                                        <input type="text" value="{{ $invoice->tax ?? 0 }}" name="tax"
                                                            class="form-control tax" min="0" required>
                                                    </td>
                                                    <td class="col-3">
                                                        <input type="text" value="{{ $invoice->grand_total ?? 0 }}" name="grand_total"
                                                            class="form-control grand_total" readonly>
                                                    </td>
                                                    <td class="col-3">
                                                        <div class="form-group">
                                                            <select name="payment_status" class="form-control select2"
                                                                id="position">
                                                                <option value="Paid" {{ isset($invoice) && $invoice->payment_status == "Paid" ? 'selected' : '' }}>Paid</option>
                                                                    <option value="Unpaid" {{ isset($invoice) && $invoice->payment_status == "Unpaid" ? 'selected' : '' }}>Unpaid</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="form-group">
                                            <label for="additional_note">Additional Note</label>
                                            <textarea name="additional_note" id="additional_note" cols="30" rows="1" class="form-control"
                                                placeholder="Additional Note">{{ $invoice->additional_note ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="col-12 text-right">
                                    <a href="{{ route('admin.invoices.index') }}" class="btn btn-info">Back</a>
                                    <x-submit-button-component />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/admin/js/custom/invoice.js') }}"></script>
@endpush
