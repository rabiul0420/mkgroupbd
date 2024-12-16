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
                                        <label>Name {!! starSign() !!}</label>
                                        <input type="text" name="name" value="{{ old('name') ?? $data->name ?? '' }}"
                                            class="form-control {!! hasError('name') !!}" placeholder="Name" />
                                        @error('name')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Email {!! starSign() !!}</label>
                                        <input type="text" name="email" value="{{ old('email') ?? $data->email ?? '' }}"
                                            class="form-control {!! hasError('email') !!}" placeholder="Email" />
                                        @error('email')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Mobile {!! starSign() !!}</label>
                                        <input type="text" name="mobile"
                                            value="{{ old('mobile') ?? $data->mobile ?? '' }}"
                                            class="form-control {!! hasError('mobile') !!}" placeholder="Mobile" />
                                        @error('mobile')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="customFile">Logo (Max: 1MB) {!! starSign() !!}</label>
                                        <div class="custom-file">
                                            <input name="logo" type="file"
                                                class="custom-file-input {!! hasError('logo') !!}" id="customFile" />
                                            <label class="custom-file-label" for="customFile">Choose Logo</label>
                                            @error('logo')
                                            {!! displayError($message) !!}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Website URL</label>
                                        <input type="text" name="website_url"
                                            value="{{ old('website_url') ?? $data->website_url ?? '' }}"
                                            class="form-control {!! hasError('website_url') !!}"
                                            placeholder="Website URL" />
                                        @error('website_url')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="basicSelect">Status {!! starSign() !!}</label>
                                        <select name="status" class="form-control {!! hasError('status') !!}"
                                            id="basicSelect">
                                            <option value="1" {{ isset($data) && $data->status === 1 ||
                                                old('status') === 1 || !isset($data) || empty(old('status')) ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ isset($data) && $data->status === 0 ||
                                                old('status') === 0 ? 'selected' : ''
                                                }}>Inactive</option>
                                        </select>
                                        @error('status')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Address {!! starSign() !!}</label>
                                        <textarea name="address" id="address"
                                            class="form-control {!! hasError('address') !!}" cols="30" rows="1"
                                            placeholder="Address">{{ old('address') ?? $data->address ?? '' }}</textarea>
                                        @error('address')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="description"
                                            class="form-control {!! hasError('description') !!}" cols="30" rows="1"
                                            placeholder="Description">{{ old('description') ?? $data->description ?? '' }}</textarea>
                                        @error('description')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 text-right">
                                    <a href="{{ route('admin.clients.index') }}" class="btn btn-info">Back</a>
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