@extends('admin.layouts.app')
@section('title', 'Invoice no ' . $data->invoice_no)
@push('css')
@endpush

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ 'Invoice no ' . $data->invoice_no }}</h2>
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
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Download</th>
                                        <th>:</th>
                                        <td>
                                            <a download="" href="{{ asset($data->invoice_pdf) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>:</th>
                                        <td>{{ $data->invoice_no ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <th>Invoice Date</th>
                                        <th>:</th>
                                        <td>{{ date('d, M y', strtotime($data->invoice_date)) ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <th>Sub Total</th>
                                        <th>:</th>
                                        <td>{{ $data->sub_total ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tax</th>
                                        <th>:</th>
                                        <td>{{ $data->tax ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Grand Total</th>
                                        <th>:</th>
                                        <td>{{ $data->grand_total ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Additional Note</th>
                                        <th>:</th>
                                        <td>{{ $data->additional_note ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Status</th>
                                        <th>:</th>
                                        <td>{{ $data->payment_status ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <th>Added By</th>
                                        <th>:</th>
                                        <td>{{ userNameById($data->created_by) ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Added On</th>
                                        <th>:</th>
                                        <td>{{ date('d M,y', strtotime($data->created_at)) ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <h2 class="text-bold text-black">Product/Items</h2>
                            <hr>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-left">Sn</th>
                                        <th class="text-left">Product/Item</th>
                                        <th class="text-left">Unit Price</th>
                                        <th class="text-left">Quantity</th>
                                        <th class="text-left">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data->invoice_data as $inv_data)
                                        <tr>
                                            <td class="text-left">{{ $loop->index + 1 }}</td>
                                            <td class="text-left">
                                                {{ $inv_data->product->name ?? '' }}
                                                @if ($inv_data->item_details !== null)
                                                    <br>
                                                    <small>{{ $inv_data->item_details ?? '' }}</small>
                                                @endif
                                            </td>
                                            <td class="text-left">{{ $inv_data->unit_price ?? '' }}</td>
                                            <td class="text-left">{{ $inv_data->quantity ?? '' }}</td>
                                            <td class="text-left">{{ $inv_data->total_price ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="b-white" colspan="3"></td>
                                        <td class="desc text-left"><b>Sub Total:</b></td>
                                        <td class="desc text-right"><b>{{ $data->sub_total ?? 0 }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td class="b-white" colspan="3"></td>
                                        <td class="desc text-left"><b>Tax</b></td>
                                        <td class="desc text-right"><b>{{ $data->tax ?? 0 }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td class="b-white" colspan="3"></td>
                                        <td class="unit text-left"> <b>Grand Total</b></td>
                                        <td class="unit text-bold text-right">{{ $data->grand_total ?? 0 }} </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-12 text-right mt-2">
                                <a href="{{ route('admin.invoices.index') }}" class="btn btn-info">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
@endpush
