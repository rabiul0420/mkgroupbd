@extends('admin.layouts.app')
@section('title','Event List')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Event List</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
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
                                <th>Title</th>
                                <th>Default Thumbnail</th>
                                <th>Description</th>
                                <th>Total Photos</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($results->count())
                            @foreach ($results as $data)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ strLimit($data->title,255) }}</td>
                                    <td>
                                        <img src="{{ asset($data->thumbnail_image) }}" alt="" class="img-responsive"
                                            height="50" width="50">
                                    </td>
                                    <td>{{ strLimit($data->description,1000) }}</td>
                                    <td>{{ $data->photos->count() ?? '' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.events.edit',$data->id) }}">
                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a class="dropdown-item delete-data" data-id="{{ 'delete-event-category-'.$data->id }}" href="javascript:void(0);">
                                                    <i data-feather="trash" class="mr-50"></i>
                                                    <span>Delete</span>
                                                </a>
                                                <form id="delete-event-category-{{ $data->id }}"
                                                    action="{{ route('admin.events.destroy',$data->id) }}" method="POST">
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
                {{ $results->links() }}
            </div>

        </div>
    </div>
</div>
@endsection