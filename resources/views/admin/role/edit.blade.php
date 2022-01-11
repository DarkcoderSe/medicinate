@extends('admin.layouts.master')
{{-- This page shows create page of roles  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Role Edit - eNigran')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Role Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/role') }}">Roles</a></li>
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
                    <div class="col-md-4">
                        <a href="{{ URL::to('admin/role') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of role to controller  --}}
                <form id="mainFromCreate" action="{{ URL::to('admin/role/update') }} " method="post">
                    @csrf 
                    <input type="hidden" name="id" value="{{ $role->id }}"> 
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/role') }} ">
                
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of role html field  --}}
                        <div class="form-group col-md-4">
                            <label>Display Name</label>
                            <input type="text" name="display_name" class="form-control" value="{{ $role->display_name }}" required>

                           
                        </div>

                        {{-- contact_no of role html field  --}}
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text"  class="form-control" value="{{ $role->name }}" disabled>

                        </div>

                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Attach Permissions to {{ $role->display_name }} </h5>
                        </div>
                    </div>
                    <div class="row mt-2">
                        @foreach($permissions as $perm)
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox custom-checkbox-outline custom-checkbox-primary mb-3">
                                <input type="checkbox" class="custom-control-input" name="perms[]" id="perm{{ $perm->id }}" value="{{ $perm->id }}"
                                {{ $role->permissions->where('id', $perm->id)->count() > 0 ? 'checked' : '' }}>

                                <label class="custom-control-label" for="perm{{ $perm->id }}">
                                    {{ $perm->display_name }}
                                </label>

                            </div>
                        </div>
                        @endforeach
                    </div>

                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/role/edit', $role->id) }}">

                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Update Role 
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
