@extends('admin.layouts.app')
@section('title',$page_title ?? "Client")
@push('css')

@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ $page_title ?? "Client" }}</h2>
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
                                        <label>Order ID {!! starSign() !!}</label>
                                        <input type="text" name="order_id"
                                            value="{{ $order_id ?? $data->order_id }}"
                                            class="form-control {!! hasError('order_id') !!}"
                                            placeholder="Order ID" readonly />
                                        @error('order_id')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
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
                                    <label>Service {!! starSign() !!}</label>
                                    <div class="form-group">
                                        <select name="service" class="form-control select2 {!! hasError('service') !!}">
                                            <option value="">Select Service</option>
                                            @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ isset($data) && $data->service_id == $service->id || old('service') ==
                                                $service->id ? 'selected' : '' }}>
                                                {{ $service->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('service')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <label>Client {!! starSign() !!}</label>
                                    <div class="form-group">
                                        <select name="client" class="form-control select2 {!! hasError('client') !!}">
                                            <option value="">Select Client</option>
                                            @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ isset($data) && $data->client_id == $client->id || old('client') ==
                                                $client->id ? 'selected' : '' }}>
                                                {{ $client->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('client')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Receive Date {!! starSign() !!}</label>
                                        <input type="text" name="receive_date"
                                            class="form-control flatpickr-human-friendly  {!! hasError('receive_date') !!}"
                                            placeholder="Receive Date">
                                        @error('receive_date')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Budget Amount {!! starSign() !!}</label>
                                        <input type="text" name="budget_amount" value="{{ old('budget_amount') ?? $data->budget_amount ?? '' }}"
                                            class="form-control {!! hasError('budget_amount') !!}" placeholder="Budget Amount" />
                                        @error('budget_amount')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Paid Amount {!! starSign() !!}</label>
                                        <input type="text" name="paid_amount" value="{{ old('paid_amount') ?? $data->paid_amount ?? '' }}"
                                            class="form-control {!! hasError('paid_amount') !!}" placeholder="Paid Amount" />
                                        @error('paid_amount')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Due Amount {!! starSign() !!}</label>
                                        <input type="text" name="due_amount" value="{{ old('due_amount') ?? $data->due_amount?? '' }}"
                                            class="form-control {!! hasError('due_amount') !!}" placeholder="Due Amount" />
                                        @error('due_amount')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Probable Duration {!! starSign() !!}</label>
                                        <input type="text" name="work_duration" value="{{ old('work_duration') ?? $data->work_duration ?? '' }}"
                                            class="form-control {!! hasError('work_duration') !!}" placeholder="Probable Duration" />
                                        @error('work_duration')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Work Order Note</label>
                                        <textarea name="order_note" id="order_note"
                                            class="form-control {!! hasError('order_note') !!}" cols="30" rows="2"
                                            placeholder="Work Order Note">{{ old('order_note') ?? $data->order_note ?? '' }}</textarea>
                                        @error('order_note')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                    

                                <div class="col-12 text-right">
                                    <a href="{{ route('admin.work-orders.index') }}" class="btn btn-info">Back</a>
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