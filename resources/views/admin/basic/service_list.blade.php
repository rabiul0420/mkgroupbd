@extends('admin.layouts.app')
@section('title','Service')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Service List</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <a href="{{ route('admin.our-services.create') }}" class="btn btn-primary">
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
                                <th>Name</th>
                                <th>Icon</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($results->count())
                            @foreach ($results as $data)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ strLimit($data->name,255) }}</td>
                                <td>
                                    @if(file_exists($data->icon))
                                    <img src="{{ asset($data->icon) }}" alt="" class="img-responsive" height="50" width="50">
                                    @else
                                    <img src="{{ asset('assets/common/images/settings.png') }}" alt="" class="img-responsive" height="50" width="50">
                                    @endif
                                </td>
                                <td>{!! strLimit($data->short_note,100) !!}</td>
                                <td>{{ $data->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                            data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.our-services.edit',$data->id) }}">
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item delete-data" data-id="{{ 'delete-service-'.$data->id }}"
                                                href="javascript:void(0);">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>
                                            <form id="delete-service-{{ $data->id }}"
                                                action="{{ route('admin.our-services.destroy',$data->id) }}"
                                                method="POST">
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