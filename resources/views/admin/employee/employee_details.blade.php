@extends('admin.layouts.app')
@section('title','Employee Profile')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Employee Profile</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="content-body">
        <section class="app-user-view">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card user-card">
                        <div class="card-body">
                            <div class="row">
                                <div
                                    class="col-xl-6 col-lg-6 d-flex flex-column justify-content-between border-container-lg">
                                    <div class="user-avatar-section">
                                        <div class="d-flex justify-content-start">
                                            <img class="img-fluid rounded" src="{{ asset($user->image) }}" height="104"
                                                width="104" alt="User avatar" />
                                            <div class="d-flex flex-column ml-1">
                                                <div class="user-info mb-1">
                                                    <h4 class="mb-0">{{ $user->name ?? '' }}</h4>
                                                    <h4 class="mb-0">{{ $user->designation->name ?? '' }}</h4>
                                                </div>
                                                <div class="">
                                                    <h5>{{ $user->email ?? '' }}</h5>
                                                    <h5>{{ $user->mobile ?? '' }}</h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center user-total-numbers">
                                        <div class="d-flex align-items-center mr-2">
                                            <div class="color-box bg-light-primary">
                                                {{-- <i data-feather="dollar-sign" class="text-primary"></i> --}}
                                                BDT
                                            </div>
                                            <div class="ml-1 mt-1">
                                                <h5 class="mb-0">{{ $user->salary ?? '0' }}</h5>
                                                <small>Monthly Salary</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-xl-6 col-lg-6 d-flex flex-column justify-content-between border-container-lg">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>CV</th>
                                                <th>:</th>
                                                <td><a target="_blank" href="{{ asset($user->cv_path) }}"
                                                        class="btn btn-info btn-sm">CV</a></td>
                                            </tr>
                                            <tr>
                                                <th>Present Address</th>
                                                <th>:</th>
                                                <td>{{ $user->present_address ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Permanent Address</th>
                                                <th>:</th>
                                                <td>{{ $user->permanent_address ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title mb-2">Information</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Father Name</th>
                                                <th>:</th>
                                                <td>{{ $user->father_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mother Name</th>
                                                <th>:</th>
                                                <td>{{ $user->mother_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date Of Birth</th>
                                                <th>:</th>
                                                <td>{{ $user->date_of_birth ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <th>:</th>
                                                <td>{{ $user->gender ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Blood Group</th>
                                                <th>:</th>
                                                <td>{{ $user->blood_group ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>National ID</th>
                                                <th>:</th>
                                                <td>{{ $user->national_id ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Joining Date</th>
                                                <th>:</th>
                                                <td>{{ date('d M, y',strtotime($user->joining_date)) ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last Working Date</th>
                                                <th>:</th>
                                                <td>{{ $user->last_working_date != Null ? date('d M,
                                                    y',strtotime($user->last_working_date)) : 'Continuing...' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-striped">
                                        <tr>
                                            <td>Employee ID</td>
                                            <th>:</th>
                                            <td>{{ $user->employee_id ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Current Status</td>
                                            <th>:</th>
                                            <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Login Permission</td>
                                            <th>:</th>
                                            <td>{{ $user->login_permission == 1 ? 'Yes' : 'No' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Display on Website</td>
                                            <th>:</th>
                                            <td>{{ $user->display_on_website == 1 ? 'Yes' : 'No' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Facebook URL</td>
                                            <th>:</th>
                                            <td>{{ $user->facebook_url ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Linkedin URL</td>
                                            <th>:</th>
                                            <td>{{ $user->linkedin_url ?? 'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12">
                                    <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                        <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                        <span class="align-middle">Permissions</span>
                                    </h6>
                                    <div class="ml-1">
                                        <div class="row">
                                            @foreach($menus as $menu_key => $menu)
                                                @if(in_array($menu->id,$user->menu_ids))
                                                    <div class="col-md-12 bg-info py-1">
                                                        <b><i data-feather="check-circle"></i>&nbsp;{{ $menu->name }}</b>
                                                    </div>
                                                @endif
                                                @foreach($menu->activities as $activity_key => $activity)
                                                    @if(in_array($activity->id,$user->activity_ids))
                                                        <div class="col-md-4 mt-1">
                                                            <p><i data-feather="check-square"></i>&nbsp;{{ $activity->activity_name }}</p>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection