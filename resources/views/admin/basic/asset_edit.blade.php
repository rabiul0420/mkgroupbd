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
                        <div class="card-header">
                            <h4 class="card-title">Bank Information</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ $route }}" class="form needs-validation" method="POST" enctype="multipart/form-data"
                                novalidate id="submit-form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Account Holder Name {!! starSign() !!}</label>
                                            <input type="text" name="bank_account_holder_name" value="{{ $data->bank_account_holder_name ?? '' }}"
                                                class="form-control max-length-input" maxlength="100" placeholder="Account Holder Name" required />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Bank Name {!! starSign() !!}</label>
                                            <input type="text" name="bank_name" value="{{ $data->bank_name ?? '' }}"
                                                class="form-control max-length-input" maxlength="100" placeholder="Bank Name" required />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Branch Name {!! starSign() !!}</label>
                                            <input type="text" name="bank_branch_name" value="{{ $data->bank_branch_name ?? '' }}"
                                                class="form-control max-length-input" maxlength="100" placeholder="Branch Name" required />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Account Number {!! starSign() !!}</label>
                                            <input type="text" name="bank_account_number" value="{{ $data->bank_account_number ?? '' }}"
                                                class="form-control max-length-input" maxlength="100"  placeholder="Account Number" required />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Current Balance {!! starSign() !!}</label>
                                            <input type="text" name="current_balance" value="{{ $data->current_balance ?? '' }}"
                                                class="form-control" placeholder="Current Balance" required />
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <h4 class="card-title">Asset Inventory</h4>
                                        <table class="table table-borderless" width="100%" id="item_table">
                                            <thead>
                                                <tr>
                                                    <th class="pl-1">Item Name {!! starSign() !!}</th>
                                                    <th class="pl-0">Item Quantity {!! starSign() !!}</th>
                                                    <th class="pl-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($data->inventories))
                                                    @foreach ($data->inventories as $item)
                                                    <tr>
                                                        <td class="pl-0">
                                                            <input name="item_name[]" value="{{ $item->item_name }}" type="text" class="form-control max-length-input" maxlength="191" placeholder="ITEM NAME" required>
                                                        </td>
                                                        <td class="pl-0">
                                                            <input name="item_quantity[]" type="text" value="{{ $item->item_quantity }}" class="form-control max-length-input" maxlength="10" placeholder="ITEM QUANTITY" required>
                                                        </td>
                                                        <td style="width: 5%">
                                                            <button type="button" class="btn btn-sm btn-danger text-right remove_item">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="mt-1">
                                            <div class="form-group">
                                                <button type="button" id="add_more_item" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                    <span class="ms-1">Add More</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h4 class="card-title">Asset Notes</h4>
                                        <table class="table table-borderless" width="100%" id="note_table">
                                            <thead>
                                                <tr>
                                                    <th class="pl-1">Note {!! starSign() !!}</th>
                                                    <th class="pl-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($data->notes))
                                                    @foreach ($data->notes as $note)
                                                    <tr>
                                                        <td class="pl-0">
                                                            <input name="note[]" value="{{ $note->note }}" type="text" class="form-control max-length-input" maxlength="250" placeholder="Note" required>
                                                        </td>
                                                        
                                                        <td style="width: 5%">
                                                            <button type="button" class="btn btn-sm btn-danger text-right remove_note">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="mt-1">
                                            <div class="form-group">
                                                <button type="button" id="add_more_note" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                    <span class="ms-1">Add More</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-right">
                                        <a href="{{ route('admin.asset-list') }}" class="btn btn-info">Back</a>
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
        $(document).on('click', '#add_more_item', function() {
            let imave_div = ` <tr>
                <td class="pl-0">
                    <input name="item_name[]" type="text" class="form-control max-length-input" maxlength="191" placeholder="ITEM NAME" required>
                </td>
                <td class="pl-0">
                    <input name="item_quantity[]" type="text" class="form-control max-length-input" maxlength="10" placeholder="ITEM QUANTITY" required>
                </td>
                <td style="width: 5%">
                    <button type="button" class="btn btn-sm btn-danger text-right remove_item">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;

            $('#item_table').find('tbody').append(imave_div);

        });

        $(document).on('click', '.remove_item', function(){
            let event = this;
            $(event).parent().parent().remove();
        });

        $(document).on('click', '#add_more_note', function() {
            let imave_div = ` <tr>
                <td class="pl-0">
                    <input name="note[]" type="text" class="form-control max-length-input" maxlength="250" placeholder="Note" required>
                </td>
                
                <td style="width: 5%">
                    <button type="button" class="btn btn-sm btn-danger text-right remove_note">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;

            $('#note_table').find('tbody').append(imave_div);

        });

        $(document).on('click', '.remove_note', function(){
            let event = this;
            $(event).parent().parent().remove();
        });
        
    </script>
@endpush
