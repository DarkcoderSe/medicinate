@extends('admin.layouts.master')
{{-- This page shows create page of paymentMethods  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Payment Method Create - eNigran')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Payment Method Create</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/payment-method') }} ">Payment Methods</a></li>
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
                        <a href="{{ URL::to('admin/payment-method') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of paymentMethod to controller  --}}
                <form id="mainFromCreate" action="{{ URL::to('admin/payment-method/submit') }}" enctype="multipart/form-data" method="post">
                    @csrf 
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/payment-method') }}">

               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of paymentMethod html field  --}}
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>

                        {{-- contact_no of paymentMethod html field  --}}
                        <div class="form-group col-md-4">
                            <label>Image</label>
                            <input type="file" id="image" name="image" class="form-control" required>

                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('image') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="status"  checked>
                                  Active
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="type" >
                                  Live
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Create Payment Method
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
