@extends('admin.layouts.master')

{{-- This page shows the list of roles  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Roles List')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Roles List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Roles List</li>
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
                        <a href="{{ URL::to('admin/role/create') }} " class="btn btn-success">
                            Add new Role
                        </a>
                        {{-- add new role button  --}}
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
                                <th scope="col">Display Name</th>
                                <th scope="col">Name</th>
                                <th scope="col">Assigned to</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->display_name }} </td>
                                <td>{{ $role->name }} </td>
                                <td>{{ $role->users->count() ?? 0 }} </td>
                                <td>
                                    <a href="{{ URL::to('admin/role/edit', $role->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <a href="{{ URL::to('admin/role/delete', $role->id) }}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
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
