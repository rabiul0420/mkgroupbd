@extends('admin.layouts.app')
@section('title', 'Asset')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Asset List</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <a href="{{ route('admin.edit-asset') }}" class="btn btn-primary">
            <i data-feather="edit"></i>
        </a>
    </div>
</div>
<div class="content-body">
    <div class="row" id="basic-table">
        <div class="col-12">
            <x-alert-component />

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bank Information</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Account Holder Name</th>
                                <th>Bank Name</th>
                                <th>Branch</th>
                                <th>Account Number</th>
                                <th>Current Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $data->bank_account_holder_name ?? 'N/A' }}</td>
                                <td>{{ $data->bank_name ?? 'N/A' }}</td>
                                <td>{{ $data->bank_branch_name ?? 'N/A' }}</td>
                                <td>{{ $data->bank_account_number ?? 'N/A' }}</td>
                                <td>{{ number_format($data->current_balance,2) ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Asset Inventory</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data) && $data->inventories->count())
                            @foreach ($data->inventories as $item)
                            <tr>
                                <td>{{ $item->item_name ?? 'N/A' }}</td>
                                <td>{{ $item->item_quantity ?? 'N/A' }}</td>
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

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Asset Notes</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data) && $data->notes->count())
                            @foreach ($data->notes as $note)
                            <tr>
                                <td>{{ $note->note ?? 'N/A' }}</td>
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