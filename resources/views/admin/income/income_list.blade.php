@extends('admin.layouts.app')
@section('title', 'Income')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Income List</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <a href="{{ route('admin.incomes.create') }}" class="btn btn-primary">
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
                <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
                    <form action="{{ route('admin.incomes.index') }}" method="GET">
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
                                    <select name="sector" class="form-control select2">
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
                                <th>Received Date</th>
                                <th>Received By</th>
                                <th>Income Amount</th>
                                <th>Payment Method</th>
                                <th>Document</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($results->count())
                            @foreach ($results as $data)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ strLimit($data->title,100) ?? '' }}</td>
                                <td>{{ $data->income_sector->name ?? '' }}</td>
                                <td>{{ date('d M, y',strtotime($data->receive_date)) ?? '' }}</td>
                                <td>{{ $data->user->name ?? '' }}</td>
                                <td>{{ $data->net_income ?? '' }}</td>
                                <td>{{ $data->payment_method ?? '' }}</td>
                                <td>
                                    @if(!empty($data->document) && file_exists($data->document))
                                    <a target="_blank" href="{{ asset($data->document) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @else
                                    {{ "N/A" }}
                                    @endif
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                            data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.incomes.show', encrypt_decrypt($data->id,'encrypt')) }}">
                                                <i data-feather="eye" class="mr-50"></i>
                                                <span>Details</span>
                                            </a>
                                            {{-- <a class="dropdown-item"
                                                href="{{ route('admin.incomes.edit', $data->id) }}">
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a> --}}
                                            <a class="dropdown-item delete-data"
                                                data-id="{{ 'delete-income-' . $data->id }}"
                                                href="javascript:void(0);">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>
                                            <form id="delete-income-{{ $data->id }}"
                                                action="{{ route('admin.incomes.destroy', $data->id) }}"
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