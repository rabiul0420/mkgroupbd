@extends('admin.layouts.app')
@section('title', 'Work Order')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Work Order List</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <a href="{{ route('admin.work-orders.create') }}" class="btn btn-primary">
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Order No.</th>
                                    <th>Title</th>
                                    <th>Service</th>
                                    <th>Client</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->count())
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $order->order_id ?? '' }}</td>
                                            <td>{{ $order->title }}</td>
                                            <td>{{ $order->service->name ?? '' }}</td>
                                            <td>{{ $order->client->name ?? '' }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                        data-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.work-orders.show', $order->order_id) }}">
                                                            <i data-feather="eye" class="mr-50"></i>
                                                            <span>View Details</span>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.work-orders.edit', $order->order_id) }}">
                                                            <i data-feather="edit-2" class="mr-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item delete-data"
                                                            data-id="{{ 'delete-order-' . $order->id }}"
                                                            href="javascript:void(0);">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                        <form id="delete-order-{{ $order->id }}"
                                                            action="{{ route('admin.work-orders.destroy', $order->id) }}"
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
                <div class="float-right">
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
