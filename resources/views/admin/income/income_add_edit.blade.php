@extends('admin.layouts.app')
@section('title',$page_title ?? "Income")
@push('css')

@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ $page_title ?? "Income" }}</h2>
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
                                    <label>Income Sector {!! starSign() !!}</label>
                                    <div class="form-group">
                                        <select name="sector" class="form-control select2 {!! hasError('sector') !!}">
                                            <option value="">Select</option>
                                            @foreach($income_sectors as $sector)
                                            <option value="{{ $sector->id }}" {{ isset($data) && $data->income_sector_id == $sector->id || old('sector') ==
                                                $sector->id ? 'selected' : '' }}>
                                                {{ $sector->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('sector')
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
                                                {{ $work_order->order_id . ' - '. $work_order->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('work_order')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <label>Received By {!! starSign() !!}</label>
                                    <div class="form-group">
                                        <select name="received_by" class="form-control select2 {!! hasError('received_by') !!}">
                                            <option value="">Select</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ isset($data) && $data->received_by == $user->id || old('received_by') ==
                                                $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('received_by')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date {!! starSign() !!}</label>
                                        <input type="text" name="receive_date" value="{{ old('receive_date') ?? $data->receive_date ?? '' }}"
                                            class="form-control flatpickr-human-friendly {!! hasError('receive_date') !!}"
                                            placeholder="Task Date">
                                            @error('receive_date')
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
                                        <label>Vat {!! starSign() !!}</label>
                                        <input type="text" name="vat" value="{{ old('vat') ?? $data->vat ?? '0' }}" class="form-control {!! hasError('vat') !!}" placeholder="Vat">
                                        @error('vat')
                                        {!! displayError('vat') !!}
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tax {!! starSign() !!}</label>
                                        <input type="text" name="tax" value="{{ old('tax') ?? $data->tax ?? '0' }}" class="form-control {!! hasError('tax') !!}" placeholder="Tax">
                                        @error('tax')
                                        {!! displayError('tax') !!}
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
                                    <a href="{{ route('admin.incomes.index') }}" class="btn btn-info">Back</a>
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