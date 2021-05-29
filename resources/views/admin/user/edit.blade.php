@extends('admin.layouts.master')
{{-- This page shows create page of users  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Student Edit - eNigran')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Student Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/user') }} ">Students</a></li>
                    <li class="breadcrumb-item active">Edit</li>

                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4 text-center">
                     
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#changePass">
                            Change Password 
                            @if($errors->any())
                            <span class="badge badge-danger">Errors</span>
                            @endif
                        </a>

                        
                        <!-- Modal -->
                        <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Change Password
                                            @if($errors->any())
                                            <span class="badge badge-danger">Error</span>
                                            @endif
                                        </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ URL::to('admin/user/change-password') }}" method="post">
                                            @csrf 
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <div class="form-row text-left">
                                                <div class="form-group col-md-12">
                                                    <label>Current Password</label>
                                                    <input type="password" class="form-control" name="current_password">
                                                    @if($errors->any())
                                                    <span class="text-danger small">
                                                        {{ $errors->first('current_password') }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <hr>
                                            </div>
                                            <div class="form-row text-left">
                                                <div class="form-group col-md-12">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control" name="password">
                                                    @if($errors->any())
                                                    <span class="text-danger small">
                                                        {{ $errors->first('password') }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row text-left">
                                                <div class="form-group col-md-12">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control" name="confirm_password">
                                                    @if($errors->any())
                                                    <span class="text-danger small">
                                                        {{ $errors->first('confirm_password') }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success">
                                                Update Password
                                            </button>
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <a href="{{ URL::to('admin/user') }}" class="btn btn-primary">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of user to controller  --}}
                <form id="mainFromCreate" action="{{ URL::to('admin/user/update') }}" method="post" enctype="multipart/form-data">
                    @csrf 
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    {{-- csrf is token for laravel form validation it is a security point --}}
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of user html field  --}}
                        <div class="form-group col-md-6">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>

                        {{-- contact_no of user html field  --}}
                        <div class="form-group col-md-6">
                            <label>Profile</label>
                            <input type="file" class="form-control" name="profile">

                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('profile') }}
                            </span>
                            @endif
                        </div>

                    </div>

                    {{-- 2nd row  --}}
                    <div class="form-row">

                        {{-- email of user html field  --}}
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" value="{{ $user->email }}" class="form-control" disabled>

                        
                        </div>

                        {{-- reg no of user html field  --}}
                        <div class="form-group col-md-6">
                            <label>Contact No.</label>
                            <input type="text" class="form-control" value="{{ $user->contact_no }}" disabled>
                                                      
                        </div>
    

                    </div>


                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary">
                        Update User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

