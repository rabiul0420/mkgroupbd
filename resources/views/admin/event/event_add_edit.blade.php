@extends('admin.layouts.app')
@section('title', $page_title ?? 'Expense Category')
@push('css')
@endpush

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ $page_title ?? 'Expense Category' }}</h2>
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
                            <form action="{{ $route }}" class="form needs-validation" method="POST" enctype="multipart/form-data"
                                novalidate id="submit_form">
                                @csrf
                                @isset($data)
                                    @method('PUT')
                                @endisset
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Title {!! starSign() !!}</label>
                                            <input type="text" name="title" value="{{ $data->title ?? '' }}"
                                                class="form-control" placeholder="Title" required />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Category {!! starSign() !!}</label>
                                            <select name="category_id" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ isset($data) && $data->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Description {!! starSign() !!}</label>
                                            <textarea name="description" class="form-control" cols="30" rows="1" placeholder="Description" required>{{ $data->description ?? '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table table-borderless" width="100%" id="image_table">
                                            <thead>
                                                <tr>
                                                    <th class="pl-1">Image Title {!! starSign() !!}</th>
                                                    <th class="pl-0">Image {!! starSign() !!}</th>
                                                    <th class="pl-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="pl-0">
                                                        <input name="image_title[]" type="text" class="form-control"
                                                            placeholder="Title" required>
                                                    </td>
                                                    <td class="pl-0">
                                                        <input name="photos[]" type="file" class="form-control" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="mt-1">
                                            <div class="form-group">
                                                <button type="button" id="add_more_image" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                    <span class="ms-1">Add More</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-right">
                                        <a href="{{ route('admin.events.index') }}" class="btn btn-info">Back</a>
                                        <button type="submit" class="btn btn-primary" id="submit_form">
                                            Submit
                                        </button>
                                        
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
    <script>
        $(document).on('click', '#add_more_image', function() {
            let imave_div = ` <tr>
                <td class="pl-0">
                    <input name="image_title[]" type="text" class="form-control" placeholder="Title" required>
                </td>
                <td class="pl-0">
                    <input name="photos[]" type="file" class="form-control" required>
                </td>
                <td style="width: 5%">
                    <button type="button" class="btn btn-sm btn-danger text-right remove_imave">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;

            $('#image_table').find('tbody').append(imave_div);

        });

        $(document).on('click', '.remove_imave', function(){
            let event = this;
            $(event).parent().parent().remove();
        });
        
    </script>
@endpush
