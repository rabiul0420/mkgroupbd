@extends('admin.layouts.app')
@section('title',$page_title ?? "Task")
@push('css')

@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ $page_title ?? "Task" }}</h2>
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
                        <form action="{{ $route }}" class="form" method="POST" id="prevent-form"
                            enctype="multipart/form-data">
                            @csrf
                            @isset($data)
                            @method('PUT')
                            @endisset
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Title {!! starSign() !!}</label>
                                        <input type="text" name="title" value="{{ old('title') ?? $data->title ?? '' }}"
                                            class="form-control {!! hasError('title') !!}" placeholder="Title" />
                                        @error('title')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <label>Category {!! starSign() !!}</label>
                                    <div class="form-group">
                                        <select name="category" class="form-control select2 {!! hasError('category') !!}">
                                            <option value="">Select</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ isset($data) && $data->category_id == $category->id || old('category') ==
                                                $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <label>Work Order</label>
                                    <div class="form-group">
                                        <select name="work_order" class="form-control select2 {!! hasError('work_order') !!}">
                                            <option value="">Select</option>
                                            @foreach($work_orders as $work_order)
                                            <option value="{{ $work_order->id }}" {{ isset($data) && $data->work_order_id == $work_order->id || old('work_order') ==
                                                $work_order->id ? 'selected' : '' }}>
                                                {{ $work_order->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('work_order')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <label>Responsible Person {!! starSign() !!}</label>
                                    <div class="form-group">
                                        <select name="responsible_person" class="form-control select2 {!! hasError('responsible_person') !!}">
                                            <option value="">Select</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ isset($data) && $data->responsible_person == $user->id || old('responsible_person') ==
                                                $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('responsible_person')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date {!! starSign() !!}</label>
                                        <input type="text" name="expense_date" value="{{ old('expense_date') ?? $data->expense_date ?? '' }}"
                                            class="form-control flatpickr-human-friendly {!! hasError('expense_date') !!}"
                                            placeholder="Task Date">
                                            @error('expense_date')
                                            {!! displayError($message) !!}
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Amount {!! starSign() !!}</label>
                                        <input type="text" name="amount" value="{{ old('amount') ?? $data->amount ?? '' }}" class="form-control {!! hasError('amount') !!}" placeholder="Amount">
                                        @error('amount')
                                        {!! displayError('amount') !!}
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="customFile">Document (Max: 1MB)</label>
                                        <div class="custom-file">
                                            <input name="document" type="file"
                                                class="custom-file-input {!! hasError('document') !!}" id="customFile" accept=".jpg,.jpeg,.png,.pdf" />
                                            <label class="custom-file-label" for="customFile">Choose document</label>
                                            @error('document')
                                            {!! displayError($message) !!}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <label>Payment Method {!! starSign() !!}</label>
                                    <div class="form-group">
                                        <select name="payment_method" class="form-control select2 {!! hasError('payment_method') !!}">
                                            <option value="">Select</option>
                                            @foreach($payment_methods as $method)
                                            <option value="{{ $method->name }}" {{ isset($data) && $data->payment_method == $method->name || old('payment_method') ==
                                                $method->name ? 'selected' : '' }}>
                                                {{ $method->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('payment_method')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                               
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea name="note" id="note"
                                            class="form-control {!! hasError('note') !!}" cols="30" rows="4"
                                            placeholder="Note">{{ old('note') ?? $data->note ?? '' }}</textarea>
                                        @error('note')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 text-right">
                                    <a href="{{ route('admin.expense-list.index') }}" class="btn btn-info">Back</a>
                                    <x-submit-button-component />
                                </div>
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

@endpush