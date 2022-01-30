@extends('admin.layouts.master')
{{-- This page shows create page of preferences  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Preference Create - eNigran')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Preference Create</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/preference') }} ">Preferences</a></li>
                    <li class="breadcrumb-item active">Create</li>

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
                        <a href="{{ URL::to('admin/preference') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of preference to controller  --}}
                <form id="mainFromCreate" action="{{ URL::to('admin/preference/submit') }} " method="post">
                    @csrf 
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/preference') }}">
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of preference html field  --}}
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
               
                        </div>

                        {{-- contact_no of preference html field  --}}
                        <div class="form-group col-md-4">
                            <label>Value</label>
                            <input type="text" name="value" class="form-control">
    
                        </div>

                    </div>


                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary">
                        Create Preference 
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
