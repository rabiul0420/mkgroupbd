@extends('admin.layouts.app')
@section('title', 'To-Do')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">To-Do List</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addToDoModal">
                <i data-feather="plus"></i>
                Add New
            </button>
            <div class="modal fade text-left" id="addToDoModal" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Add To-Do</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" id="add-to-do">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>To-Do {!! starSign() !!}</label>
                                            <input type="text" name="title" class="form-control title_field"
                                                placeholder="To-Do">
                                            <span class="text-danger to-do-error-message title_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date {!! starSign() !!}</label>
                                            <input type="text" name="to_do_date"
                                                class="form-control flatpickr-human-friendly to_do_date_field"
                                                placeholder="Date">
                                            <span class="text-danger to-do-error-message to_do_date_error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Priority {!! starSign() !!}</label>
                                            <select name="priority" class="form-control priority_field">
                                                <option value="High">High</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Low">Low</option>
                                            </select>
                                            <span class="text-danger to-do-error-message priority_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="submit-to-do" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row" id="table-hover-animation">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="search_title" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" id="search_to_do_date" class="form-control flatpickr-human-friendly"
                                    placeholder="Date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select id="search_priority" class="form-control">
                                    <option value="">Select Priority</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-block" id="search-to-do">Search</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover-animation table-striped" id="to-do-list-table">
                            <thead>
                                <tr>
                                    <th>To-Do</th>
                                    <th>Date</th>
                                    <th>priority </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade text-left" id="editToDoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header edit-to-do-modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit To-Do</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="to-do-edit-form"></div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let base_url = $('meta[name="base-url"]').attr('base_url');

        $(document).ready(function() {
            loadToDo();
        });

        $(document).on('click','#search-to-do',function() {
            loadToDo();
        });

        $(document).on('click', '#submit-to-do', function(event) {
            event.preventDefault();
            $.ajax({
                url: base_url + '/to-do-list',
                method: 'POST',
                data: $('#add-to-do').serialize(),
                dataType: 'json',
                success: function(response) {
                    $('.form-control').removeClass('is-invalid');
                    $('.to-do-error-message').empty();
                    if (response.status == 'success') {
                        $('#addToDoModal').modal('hide');
                        Swal.fire({
                            position: 'top-end',
                            text: response.message,
                            icon: "success",
                            timer: 2000
                        });
                        $('#add-to-do')[0].reset();
                        loadToDo();
                    } else if (response.status == 'error') {
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            timer: 2000
                        })

                    }
                },
                error: function(error) {
                    if (error.status === 422) {
                        let errors = error.responseJSON.errors;
                        $('.to-do-error-message').empty();
                        $.each(errors, function(field, messages) {
                            $('.' + field + '_field').addClass('is-invalid');
                            $('.' + field + '_error').empty().text(messages[0]);
                        });
                    }
                }
            });
        });

        function loadToDo() {
            let searchParam = {
                title: $('#search_title').val(),
                to_do_date: $('#search_to_do_date').val(),
                priority: $('#search_priority').val()
            };
            axios.get(base_url + '/user-wise-to-do', {
                params: searchParam
            }).then(response => {
                let data_div = "";
                if(response.data.length) {
                $(response.data).each(function(index, value) {
                    data_div += `<tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="${ value.id }" class="custom-control-input to-do-input" id="to_do_${ value.id }" ${ value.status == 1 ? 'checked' : '' } />
                                <label class="custom-control-label todo-title" for="to_do_${ value.id }">${ value.title }</label>
                            </div>
                        </td>
                        <td>${value.to_do_date}</td>
                        <td>
                            <span class="badge badge-pill badge-light-primary">${ value.priority }</span>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-to-do" data-id="${value.id}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-to-do" data-id="${value.id}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>`;
                    });
                } 
                $('#to-do-list-table').find('tbody').html(data_div);
            });
        }

        $(document).on('click', '.to-do-input', function() {
            const checkboxValue = $(this).val();
            const isChecked = $(this).is(':checked');
            let status = '';
            if (isChecked) {
                status = 1;
            } else {
                status = 0;
            }
            axios.get(base_url + '/update-to-do', {
                params: {
                    id: checkboxValue,
                    status: status
                }
            });
            loadToDo();
        });

        $(document).on('click', '.edit-to-do', function() {
            const data_id = $(this).attr('data-id');
            axios.get(base_url + '/to-do-list/' + data_id).then(response => {
                let to_do = response.data;
                let edit_form = `
                <form method="POST" id="edit-to-do-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>To-Do {!! starSign() !!}</label>
                                    <input type="text" value="${ to_do.title }" name="title" class="form-control title_field"
                                        placeholder="To-Do">
                                    <span class="text-danger to-do-error-message title_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date {!! starSign() !!}</label>
                                    <input type="text" name="to_do_date" value="${ to_do.to_do_date }"
                                        class="form-control custom-date-picker to_do_date_field" placeholder="Date">
                                    <span class="text-danger to-do-error-message to_do_date_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label>Priority {!! starSign() !!}</label>
                                    <select name="priority" class="form-control priority_field">
                                        <option value="High" ${ to_do.priority == "High" ? 'selected' : '' }>High</option>
                                        <option value="Medium" ${ to_do.priority == "Medium" ? 'selected' : '' }>Medium</option>
                                        <option value="Low" ${ to_do.priority == "Low" ? 'selected' : '' }>Low</option>
                                    </select>
                                    <span class="text-danger to-do-error-message priority_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="update-to-do" data-id="${ to_do.id }" class="btn btn-primary">Update</button>
                    </div>
                </form>`;
                $('#editToDoModal').modal('show');
                $('.to-do-edit-form').empty().html(edit_form);
                $('#editToDoModal').on('shown.bs.modal', function() {
                    $('.custom-date-picker').flatpickr({
                        altInput: true,
                        altFormat: 'F j, Y',
                        dateFormat: 'Y-m-d',
                        defaultDate: to_do.to_do_date
                    });
                });
            });
        });

        $(document).on('click', '#update-to-do', function(event) {
            event.preventDefault();
            let data_id = $(this).attr('data-id');
            $.ajax({
                url: base_url + '/to-do-list/' + data_id,
                method: 'PUT',
                data: $('#edit-to-do-data').serialize(),
                dataType: 'json',
                success: function(response) {
                    $('.form-control').removeClass('is-invalid');
                    $('.to-do-error-message').empty();
                    if (response.status == 'success') {
                        $('#editToDoModal').modal('hide');
                        Swal.fire({
                            position: 'top-end',
                            text: response.message,
                            icon: "success",
                            timer: 2000
                        });
                        $('#edit-to-do-data')[0].reset();
                        loadToDo();
                    } else if (response.status == 'error') {
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            timer: 2000
                        })

                    }
                },
                error: function(error) {
                    if (error.status === 422) {
                        let errors = error.responseJSON.errors;
                        $('.to-do-error-message').empty();
                        $.each(errors, function(field, messages) {
                            $('.' + field + '_field').addClass('is-invalid');
                            $('.' + field + '_error').empty().text(messages[0]);
                        });
                    }
                }
            });
        });

        $(document).on('click', '.delete-to-do', function(event) {
            const data_id = $(this).attr('data-id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    axios.delete(base_url + '/to-do-list/' + data_id).then(response => {
                        console.log("to do ", response);
                        Swal.fire({
                            position: 'top-end',
                            text: response.data.message,
                            icon: "success",
                            timer: 2000
                        });
                        loadToDo();
                    });

                }
            });
        });
    </script>
@endpush
