@extends('admin.layouts.app')
@section('title', 'Task')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Task List</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <a href="{{ route('admin.task-list.create') }}" class="btn btn-primary">
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
                                <th>Task Title</th>
                                <th>Assigned To</th>
                                <th>Assign Date</th>
                                <th>Description</th>
                                <th>Document</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($results->count())
                            @foreach ($results as $task)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->user->name ?? '' }}</td>
                                <td>{{ date('M d, y',strtotime($task->task_date)) }}</td>
                                <td>{{ $task->description ?? 'N/A' }}</td>
                                <td>
                                    @if($task->document_path != Null && file_exists($task->document_path))
                                    <a target="_blank" href="{{ asset($task->document_path) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @else
                                    {{ "N/A" }}
                                    @endif
                                </td>
                                <td>
                                    @if($task->status == 'Pending')
                                        <span class="badge badge-danger">{{ $task->status }}</span>
                                    @elseif($task->status == 'In-Progress')
                                        <span class="badge badge-warning">{{ $task->status }}</span>
                                    @elseif($task->status == 'Pending')
                                        <span class="badge badge-success">{{ $task->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                            data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.task-list.edit', $task->id) }}">
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item delete-data"
                                                data-id="{{ 'delete-task-' . $task->id }}" href="javascript:void(0);">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>
                                            <form id="delete-task-{{ $task->id }}"
                                                action="{{ route('admin.task-list.destroy', $task->id) }}"
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
        </div>
    </div>
</div>
@endsection