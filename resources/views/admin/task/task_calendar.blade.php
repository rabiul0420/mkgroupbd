@extends('admin.layouts.app')
@section('title', 'Task')
@push('css')
<link rel='stylesheet' href="{{ asset('assets/admin/full-calendar/main.css') }}" />


@endpush
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Task Calendar</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Full calendar start -->
    <section>
        <div class="app-calendar overflow-hidden border">
            <div class="row no-gutters">
                <div class="col position-relative">
                    <div class="card shadow-none border-0 mb-0 rounded-0">
                        <div class="card-body pb-0">
                            <div id="task-calendar"></div>
                        </div>
                    </div>
                </div>
                <div class="body-content-overlay"></div>
            </div>
        </div>

        <div class="modal fade text-left" id="task-details" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header edit-to-do-modal-header">
                        <h4 class="modal-title" id="task-details-modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  h-100-vh" id="task-details-modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger td_close_modal"
                            data="task-details">Close</button>
                    </div>
                </div>
            </div>
        </div>

       
    </section>
    <!-- Full calendar end -->

</div>
@endsection

@push('js')
<script src="{{ asset('assets/admin/js/custom/task_calendar.js') }}"></script>
@endpush