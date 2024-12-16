@extends('admin.layouts.app')
@section('title','Faq Add/Edit')
@push('css')

@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Faq Add/Edit</h2>
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
                        <form action="{{ $route }}" class="form" method="POST">
                            @csrf
                            @isset($data)
                                @method('PUT')
                            @endisset
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Question {!! starSign() !!}</label>
                                        <input type="text" name="question"
                                            value="{{ old('question') ?? $data->question ?? '' }}"
                                            class="form-control {!! hasError('question') !!}" placeholder="Question" />
                                        @error('question')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Answer {!! starSign() !!}</label>
                                        <textarea name="answer" id="answer" class="form-control {!! hasError('answer') !!}" cols="30" rows="5"
                                            placeholder="Answer">{{ old('answer') ?? $data->answer ?? '' }}</textarea>
                                        @error('answer')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 text-right">
                                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-info">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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