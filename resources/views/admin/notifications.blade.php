@extends('admin.layouts.app')
@section('title', 'Notifications')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Notifications</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        {{-- <a href="{{ route('admin.task-list.create') }}" class="btn btn-primary">
            <i data-feather="plus"></i>
            Add New
        </a> --}}
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
                                <th>Notification</th>
                                <th>Creation Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($notifications->count())
                            @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $notification->notification_text ?? '' }}</td>
                                <td>{{ date('M d, y',strtotime($notification->created_at)) }}</td>                               
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