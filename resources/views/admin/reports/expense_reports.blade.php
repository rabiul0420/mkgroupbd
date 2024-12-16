@extends('admin.layouts.app')
@section('title', 'Expense')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Expense Report</h2>
            </div>
        </div>
    </div>
    {{-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <a href="{{ route('admin.expense-list.create') }}" class="btn btn-primary">
            <i data-feather="plus"></i>
            Add New
        </a>
    </div> --}}
</div>
<div class="content-body">
    <div class="row" id="basic-table">
        <div class="col-12">
            <x-alert-component />
            <div class="card">
                <div class="search-box p-1">
                    <form action="{{ route('admin.expense-reports') }}" method="GET">
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
                                    <select name="category" class="form-control select2">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ isset($search_category) && $search_category == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="responsible_person" class="form-control select2">
                                        <option value="">Select Responsible Person</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ isset($responsible_person) && $responsible_person == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="payment_method" class="form-control select2">
                                        <option value="">Payment Method</option>
                                        @foreach($payment_methods as $method)
                                        <option value="{{ $method->name }}" {{ isset($payment_method) && $payment_method == $method->id ? 'selected' : '' }}>{{ $method->name }}</option>
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
                                <th>Category</th>
                                <th>Expense Date</th>
                                <th>Responsible Person</th>
                                <th>Amount</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($results))
                            @foreach ($results as $data)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{$data->title ?? '' }}</td>
                                <td>{{ $data->category->name ?? '' }}</td>
                                <td>{{ date('d M, y',strtotime($data->expense_date)) ?? '' }}</td>
                                <td>{{ $data->user->name ?? '' }}</td>
                                <td>{{ $data->amount ?? '' }}</td>
                                <td>{{ $data->note ?? '' }}</td>
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