@extends('admin.layouts.master')

{{-- This page shows the list of users  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Users List')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Users List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users List</li>
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
                    {{-- URL::to is built in laravel function redirect to specific route  --}}
                    <div class="col-md-4">
                        <a href="{{ URL::to('admin/user/create') }} " class="btn btn-success">
                            Add new user
                        </a>
                        {{-- add new user button  --}}
                    </div>
                    <div class="col-md-4 text-center">
                        
                    </div>
                    <div class="col-md-4">
                        <a href="{{ URL::to('admin/home') }} " class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dt-table" class="table table-centered table-nowrap table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('admin/user/edit', $user->id) }}">
                                        {{ $user->name }}
                                    </a> 
                                </td>
                                <td>{{ $user->roles->first()->name ?? '' }} </td>
                                <td>{{ $user->email }} </td>
                                <td>{{ $user->contact_no ?? '' }} </td>
                                <td>
                                    <a class='text-danger' href='{{ URL::to('admin/user/delete', $user->id) }}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete'><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
