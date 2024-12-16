@extends('admin.layouts.app')
@section('title', 'Employee')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Employee List</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
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
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($employees->count())
                                    @foreach ($employees as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <img src="{{ asset($user->image) }}" alt="" class="img-responsive"
                                                    height="50" width="50">
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile }}</td>
                                            <td>{{ $user->status == 1 ? 'Active' : 'In Active' }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                        data-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.employees.show', $user->employee_id) }}">
                                                            <i data-feather="eye" class="mr-50"></i>
                                                            <span>Profile</span>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.employees.edit', $user->employee_id) }}">
                                                            <i data-feather="edit-2" class="mr-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item delete-data"
                                                            data-id="{{ 'delete-user-' . $user->id }}"
                                                            href="javascript:void(0);">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                        <form id="delete-user-{{ $user->id }}"
                                                            action="{{ route('admin.employees.destroy', $user->id) }}"
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
                    {{ $employees->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection