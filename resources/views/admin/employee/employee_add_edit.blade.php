@extends('admin.layouts.app')
@section('title',$page_title ?? "Client")
@push('css')

@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ $page_title ?? "Client" }}</h2>
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
                        <form action="{{ $route }}" class="form" method="POST" id="prevent-form"
                            enctype="multipart/form-data">
                            @csrf
                            @isset($data)
                            @method('PUT')
                            @endisset
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Employee ID {!! starSign() !!}</label>
                                        <input type="text" name="employee_id"
                                            value="{{ $employee_id ?? $data->employee_id }}"
                                            class="form-control {!! hasError('employee_id') !!}"
                                            placeholder="Employee ID"  />
                                        @error('employee_id')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Name {!! starSign() !!}</label>
                                        <input type="text" name="name" value="{{ old('name') ?? $data->name ?? '' }}"
                                            class="form-control {!! hasError('name') !!}" placeholder="Name" />
                                        @error('name')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Father Name {!! starSign() !!}</label>
                                        <input type="text" name="father_name"
                                            value="{{ old('father_name') ?? $data->father_name ?? '' }}"
                                            class="form-control {!! hasError('father_name') !!}"
                                            placeholder="Father Name" />
                                        @error('father_name')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Mother Name {!! starSign() !!}</label>
                                        <input type="text" name="mother_name"
                                            value="{{ old('mother_name') ?? $data->mother_name ?? '' }}"
                                            class="form-control {!! hasError('mother_name') !!}"
                                            placeholder="Mother Name" />
                                        @error('mother_name')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>National ID {!! starSign() !!}</label>
                                        <input type="number" name="national_id"
                                            value="{{ old('national_id') ?? $data->national_id ?? '' }}"
                                            class="form-control {!! hasError('national_id ') !!}"
                                            placeholder="National ID" />
                                        @error('national_id')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date Of Birth {!! starSign() !!}</label>
                                        <input type="text" name="date_of_birth"
                                            class="form-control flatpickr-human-friendly  {!! hasError('date_of_birth') !!}"
                                            placeholder="Date Of Birth">
                                        @error('date_of_birth')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Gender {!! starSign() !!}</label>
                                        <select name="gender" class="form-control select2 {!! hasError('gender') !!}">
                                            <option value="" {{ !isset($data) && empty(old('gender')) ? 'selected' : ''
                                                }}>Select Gender</option>
                                            <option value="Male" {{ (isset($data) && $data->gender == "Male") ||
                                                (old('gender') == "Male") ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ isset($data) && $data->gender == 'Female' ||
                                                old('gender') == 'Female' ? 'selected' : ''
                                                }}>Female</option>
                                        </select>
                                        @error('gender')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-gorup">
                                        <label>Blood Goup {!! starSign() !!}</label>
                                        <select name="blood_group"
                                            class="form-control select2 {!! hasError('blood_group') !!}">
                                            <option value="">Select Blood Group</option>
                                            @foreach (bloodGroups() as $group)
                                            <option value="{{ $group }}" {{ isset($data) && $data->blood_group == $group
                                                || old('blood_group') == $group ? 'selected' : '' }}>{{ $group }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('blood_group')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Email {!! starSign() !!}</label>
                                        <input type="text" name="email" value="{{ old('email') ?? $data->email ?? '' }}"
                                            class="form-control {!! hasError('email') !!}" placeholder="Email" />
                                        @error('email')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Mobile {!! starSign() !!}</label>
                                        <input type="text" name="mobile"
                                            value="{{ old('mobile') ?? $data->mobile ?? '' }}"
                                            class="form-control {!! hasError('mobile') !!}" placeholder="Mobile" />
                                        @error('mobile')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Password @if(!isset($data)) {!! starSign() !!} @endif</label>
                                        <input type="password" name="password" value=""
                                            class="form-control {!! hasError('password') !!}" placeholder="Password" />
                                        @error('password')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <label>Designation {!! starSign() !!}</label>
                                    <div class="form-group">
                                        <select name="designation"
                                            class="form-control select2 {!! hasError('designation') !!}">
                                            <option value="">Select Designation</option>
                                            @foreach($designations as $designation)
                                            <option value="{{ $designation->id }}" {{ isset($data) && $data->
                                                designation_id == $designation->id || old('designation') ==
                                                $designation->id ? 'selected' : '' }}>
                                                {{ $designation->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('designation')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Login Permission {!! starSign() !!}</label>
                                        <select name="login_permission" id="login_permission"
                                            class="form-control select2 {!! hasError('login_permission') !!}">
                                            <option value="0" {{ isset($data) && $data->login_permission == 0 || old('login_permission') ==  0 ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ isset($data) && $data->login_permission == 1 || old('login_permission') ==  1 ? 'selected' : '' }}>Yes</option>
                                        </select>
                                        @error('login_permission')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="customFile">Photo (Max: 1MB)
                                            @if(!isset($data))
                                            {!! starSign() !!}
                                            @elseif(isset($data) && is_null($data->image))
                                            {!! starSign() !!}
                                            @endif
                                        </label>
                                        <div class="custom-file">
                                            <input name="photo" type="file"
                                                class="custom-file-input {!! hasError('photo') !!}" id="customFile"
                                                accept=".jpg,.jpeg,.png" />
                                            <label class="custom-file-label" for="customFile">Choose photo</label>
                                            @error('photo')
                                            {!! displayError($message) !!}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="customFile">CV (Max: 1MB) {!! starSign() !!}</label>
                                        <div class="custom-file">
                                            <input name="cv_file" type="file"
                                                class="custom-file-input {!! hasError('cv_file') !!}" id="customFile"
                                                accept=".pdf" />
                                            <label class="custom-file-label" for="customFile">Choose CV</label>
                                            @error('cv_file')
                                            {!! displayError($message) !!}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Joing Date {!! starSign() !!}</label>
                                        <input type="text" name="joining_date"
                                            class="form-control flatpickr-human-friendly  {!! hasError('joining_date') !!}"
                                            placeholder="Joing Date">
                                        @error('joining_date')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last Working Date</label>
                                        <input type="text" name="last_working_date"
                                            class="form-control date-picker-empty {!! hasError('last_working_date') !!}"
                                            placeholder="Last Working Date">
                                        @error('date_of_birth')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Salary {!! starSign() !!}</label>
                                        <input type="number" name="salary"
                                            value="{{ old('salary') ?? $data->salary ?? '' }}"
                                            class="form-control {!! hasError('salary') !!}" placeholder="Salary" />
                                        @error('salary')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Linkedin URL</label>
                                        <input type="text" name="linkedin_url"
                                            value="{{ old('linkedin_url') ?? $data->linkedin_url ?? '' }}"
                                            class="form-control {!! hasError('linkedin_url') !!}"
                                            placeholder="Linkedin URL" />
                                        @error('linkedin_url')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Facebook URL</label>
                                        <input type="text" name="facebook_url"
                                            value="{{ old('facebook_url') ?? $data->facebook_url ?? '' }}"
                                            class="form-control {!! hasError('facebook_url') !!}"
                                            placeholder="Facebook URL" />
                                        @error('facebook_url')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Status {!! starSign() !!}</label>
                                        <select name="status" class="form-control select2 {!! hasError('status') !!}">
                                            <option value="1" {{ isset($data) && $data->status === 1 ||
                                                old('status') === 1 || !isset($data) || empty(old('status')) ?
                                                'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ isset($data) && $data->status === 0 ||
                                                old('status') === 0 ? 'selected' : ''
                                                }}>Inactive</option>
                                        </select>
                                        @error('status')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Display on Website {!! starSign() !!}</label>
                                        <select name="display_on_website"
                                            class="form-control select2 {!! hasError('display_on_website') !!}">
                                            <option value="1" {{ isset($data) && $data->display_on_website === 1 ||
                                                old('display_on_website') === 1 || !isset($data) ||
                                                empty(old('display_on_website')) ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="0" {{ isset($data) && $data->display_on_website === 0 ||
                                                old('display_on_website') === 0 ? 'selected' : ''
                                                }}>No</option>
                                        </select>
                                        @error('display_on_website')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Present Address {!! starSign() !!}</label>
                                        <input type="text" name="present_address"
                                            value="{{ old('present_address') ?? $data->present_address ?? '' }}"
                                            class="form-control {!! hasError('present_address') !!}"
                                            placeholder="Present Address" />
                                        @error('present_address')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Permanent Address {!! starSign() !!}</label>
                                        <input type="text" name="permanent_address"
                                            value="{{ old('permanent_address') ?? $data->permanent_address ?? '' }}"
                                            class="form-control {!! hasError('permanent_address') !!}"
                                            placeholder="Permanent Address" />
                                        @error('permanent_address')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                <span class="align-middle">Permission</span>
                                            </h6>
                                            <span class="py-1 mx-1 mb-0">
                                                <input type="checkbox" id="select_all_role">
                                                <label for="select_all_role">Select All</label>
                                            </span>
                                        </div>
                    
                                        @foreach($menus as $menu_key => $menu)
                                            @if($menu->title != 'Profile')
                                                <div class="col-md-12 bg-info ">
                                                    <div class="form-group mt-1">
                                                        <input
                                                            {{ isset($data) && in_array($menu->id,$data->menu_ids) ? 'checked' : '' }}
                                                            id="menu_{{ $menu->id }}"
                                                            class="menu_class check_menu_{{ $menu->id }}"
                                                            data-name = "{{ $menu_key + 1 }}"
                                                            data-id = {{ $menu->id }}
                                                            type="checkbox"
                                                            value="{{ $menu->id }}">
                                                            <label for="menu_{{ $menu->id }}"><b>{{ $menu->name }}</b></label>
                                                    </div>
                                                </div>
                                            @endif    
                    
                                            @foreach($menu->activities as $activity_key => $activity)
                                                <div class="col-md-4 mt-1">
                                                    <div class="form-group">
                                                        <input
                                                            {{ isset($data) && in_array($activity->id,$data->activity_ids) || $activity->auto_select == "Yes" ? 'checked' : '' }}
                                                            id="menu_activity_{{ $activity->id }}"
                                                            data-id = "{{ $menu->id }}"
                                                            class="activity_class menu_activities_{{ $menu->id }}"
                                                            type="checkbox"
                                                            name="activity_id[]"
                                                            value="{{ $activity->id }}">
                                                        <label for="menu_activity_{{ $activity->id }}">{{ $activity->activity_name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-12 text-right">
                                    <a href="{{ route('admin.employees.index') }}" class="btn btn-info">Back</a>
                                    <x-submit-button-component />
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
    $( document ).on('click','#select_all_role', function() {
        if($(this).is(':checked')) {
            $(".menu_class").prop("checked", true);
            $(".activity_class").prop("checked", true);
        } else {
            $(".menu_class").prop("checked", false);
            $(".activity_class").prop("checked", false);
        }
    });

    $( document ).on('click','.menu_class', function() {
        let data_id = $(this).attr('data-id');
        if($(this).is(':checked')) {
            $(".menu_activities_"+data_id).prop("checked", true);
        } else {
            $(".menu_activities_"+data_id).prop("checked", false);
        }
    });

    $( document ).on('click','.activity_class', function() {
        let menu_key = $(this).attr('data-id');
        if($(this).is(':checked')) {
            $('#menu_'+menu_key).prop('checked',true);
        }
    });
</script>

@endpush