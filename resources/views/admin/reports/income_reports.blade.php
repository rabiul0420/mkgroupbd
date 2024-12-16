@extends('admin.layouts.app')
@section('title', 'Income Reports')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Income Reports</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="row" id="basic-table">
        <div class="col-12">
            <x-alert-component />
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
                    <form action="{{ route('admin.income-reports') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <input type="text" value="{{ $title ?? '' }}" name="title" class="form-control" placeholder="Title">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <input type="text" value="{{ $from_date ?? '' }}" name="from_date" class="form-control date-picker-empty"
                                        placeholder="From Date">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <input type="text" value="{{ $to_date ?? '' }}" name="to_date" class="form-control date-picker-empty"
                                        placeholder="To Date">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <select name="income_sector" class="form-control select2">
                                        <option value="">Income Sector</option>
                                        @foreach($income_sectors as $sector)
                                        <option value="{{ $sector->id }}" {{ isset($search_sector) && $search_sector == $sector->id ? 'selected' : '' }}>
                                            {{ $sector->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="received_by" class="form-control select2">
                                        <option value="">Received By</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ isset($received_by) && $received_by == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="payment_method" class="form-control select2">
                                        <option value="">Payment Method</option>
                                        @foreach($payment_methods as $method)
                                        <option value="{{ $method->name }}" {{ isset($payment_method) && $payment_method == $method->name ? 'selected' : '' }}>{{ $method->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="work_order" class="form-control select2">
                                        <option value="">Work Order</option>
                                        @foreach($work_orders as $order)
                                        <option value="{{ $order->id }}" {{ isset($work_order) && $work_order == $order->id ? 'selected' : '' }}>
                                            {{ $order->order_id.' - '.$order->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="display_type" class="form-control select2">
                                        <option value="show_data">Show Data</option>
                                        <option value="download_pdf">Download as Pdf</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-1">
                                    <input type="checkbox" name="display_all" id="display_all" class="menu_class">
                                    <label for="display_all">Display All</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"
                                        id="search-to-do">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Income Sector</th>
                                <th>Work Order</th>
                                <th>Received Date</th>
                                <th>Received By</th>
                                <th>Income Amount</th>
                                <th>Vat</th>
                                <th>Tax</th>
                                <th>Net Income</th>
                                <th>Payment Method</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($results))
                            @foreach ($results as $data)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ strLimit($data->title,100) ?? 'N/A' }}</td>
                                <td>{{ $data->income_sector->name ?? 'N/A' }}</td>
                                <td>{{ $data->work_order->name ?? 'N/A' }}</td>
                                <td>{{ date('d M, y',strtotime($data->receive_date)) ?? 'N/A' }}</td>
                                <td>{{ $data->user->name ?? 'N/A' }}</td>
                                <td>{{ $data->amount ?? 'N/A' }}</td>
                                <td>{{ $data->vat ?? 'N/A' }}</td>
                                <td>{{ $data->tax ?? 'N/A' }}</td>
                                <td>{{ $data->net_income ?? 'N/A' }}</td>
                                <td>{{ $data->payment_method ?? 'N/A' }}</td>
                                <td>{{ $data->note ?? 'N/A' }}</td>
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