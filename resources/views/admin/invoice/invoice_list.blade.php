@extends('admin.layouts.app')
@section('title', 'Invoice')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Invoice List</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
                <i data-feather="plus"></i>
                Add New
            </a>
        </div>
    </div>
    <div class="content-body">
        <div class="row" id="basic-table">
            <div class="col-12">
                <x-alert-component />
                
                <div class="card">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Invoice No.</th>
                                    <th>Invoice Date</th>
                                    <th>Total Price</th>
                                    <th>Payment Status</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($invoices->count())
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $invoice->invoice_no ?? '' }}</td>
                                            <td>{{ date('d M, Y',strtotime($invoice->invoice_date)) ?? '' }}</td>
                                            <td>{{ $invoice->grand_total ?? '' }}</td>
                                            <td>{{ $invoice->payment_status ?? '' }}</td>
                                            
                                            <td>{{ userNameById($invoice->created_by) }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                        data-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ asset($invoice->invoice_pdf) }}" download>
                                                            <i data-feather="file" class="mr-50"></i>
                                                            <span>Download</span>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.invoices.show', $invoice->invoice_no) }}">
                                                            <i data-feather="eye" class="mr-50"></i>
                                                            <span>Details</span>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.invoices.edit', $invoice->id) }}">
                                                            <i data-feather="edit-2" class="mr-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item delete-invoice"
                                                            data-id="{{ 'delete-expense-' . $invoice->id }}"
                                                            href="javascript:void(0);">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                        <form id="delete-invoice-{{ $invoice->id }}"
                                                            action="{{ route('admin.invoices.destroy', $invoice->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <x-alert-danger />
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
