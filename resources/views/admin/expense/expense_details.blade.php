@extends('admin.layouts.app')
@section('title','Expense Details')
@push('css')

@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ 'Expense Details' }}</h2>
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
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Title</th>
                                    <th>:</th>
                                    <td>{{ $data->title ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Document</th>
                                    <th>:</th>
                                    <td>
                                        @if(!empty($data->document) && file_exists($data->document))
                                        <a target="_blank" href="{{ asset($data->document) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @else
                                        {{ "N/A" }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <th>:</th>
                                    <td>{{ $data->amount ?? '' }}</td>
                                </tr>
                                
                                <tr>
                                    <th>Category</th>
                                    <th>:</th>
                                    <td>{{ $data->category->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Expense Date</th>
                                    <th>:</th>
                                    <td>{{ date('d, M y',strtotime($data->expense_date)) ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Responsible Person</th>
                                    <th>:</th>
                                    <td>{{ $data->user->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Work Order</th>
                                    <th>:</th>
                                    <td>{{ $data->work_order->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <th>:</th>
                                    <td>{{ $data->payment_method ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Note</th>
                                    <th>:</th>
                                    <td>{{ $data->note ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Added By</th>
                                    <th>:</th>
                                    <td>{{ userNameById($data->added_by) ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Added On</th>
                                    <th>:</th>
                                    <td>{{ date('d M,y',strtotime($data->created_at)) ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-12 text-right mt-2">
                            <a href="{{ route('admin.expense-list.index') }}" class="btn btn-info">Back</a>
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