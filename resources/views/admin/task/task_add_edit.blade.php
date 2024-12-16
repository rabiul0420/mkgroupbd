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
                                    <label>Assigned To {!! starSign() !!}</label>
                                    <div class="form-group">
                                        <select name="assigned_to" class="form-control select2 {!! hasError('assigned_to') !!}">
                                            <option value="">Select</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ isset($data) && $data->assigned_to == $user->id || old('assigned_to') ==
                                                $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('assigned_to')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date {!! starSign() !!}</label>
                                        <input type="text" name="task_date" value="{{ old('task_date') ?? $data->task_date ?? '' }}"
                                            class="form-control flatpickr-human-friendly"
                                            placeholder="Task Date">
                                            @error('task_date')
                                            {!! displayError($message) !!}
                                            @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="customFile">Document (Max: 1MB) </label>
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
                                    <div class="form-group">
                                        <label>Status {!! starSign() !!}</label>
                                        <select name="status" class="form-control select2">
                                            <option value="Pending">Pending</option>
                                            <option value="In-Progress">In-Progress</option>
                                            <option value="Done">Done</option>
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Description {!! starSign() !!}</label>
                                        <textarea name="description" id="description"
                                            class="form-control {!! hasError('description') !!}" cols="30" rows="4"
                                            placeholder="Description">{{ old('description') ?? $data->description ?? '' }}</textarea>
                                        @error('description')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 text-right">
                                    <a href="{{ route('admin.task-list.index') }}" class="btn btn-info">Back</a>
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