@extends('admin.layouts.app')
@section('title',$page_title ?? 'Payment Method')
@push('css')

@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ $page_title ?? 'Payment Method' }}</h2>
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
                        <form action="{{ $route }}" class="form" method="POST" id="prevent-form">
                            @csrf
                            @isset($data)
                                @method('PUT')
                            @endisset
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Name {!! starSign() !!}</label>
                                        <input type="text" name="name"
                                            value="{{ old('name') ?? $data->name ?? '' }}"
                                            class="form-control {!! hasError('name') !!}" placeholder="Name" />
                                        @error('name')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Description {!! starSign() !!}</label>
                                        <textarea name="description" class="form-control {!! hasError('description') !!}" cols="30" rows="4"
                                            placeholder="Description">{{ old('description') ?? $data->description ?? '' }}</textarea>
                                        @error('description')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 text-right">
                                    <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-info">Back</a>
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