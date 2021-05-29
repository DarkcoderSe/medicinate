@extends('admin.layouts.master')

@section('title', 'Coupon Create - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Coupon Create</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/coupon') }}">Coupons</a></li>
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
                        <a href="{{ URL::to('admin/coupon') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of paymentMethod to controller  --}}
                <form action="{{ URL::to('admin/coupon/submit') }}" enctype="multipart/form-data" method="post">
                    @csrf 
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/coupon') }}">

               
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->has('code'))
                            <span class="small text-danger">
                                {{ $errors->first('code') }}
                            </span>
                            @endif
                        </div>

                        {{-- contact_no of paymentMethod html field  --}}
                        <div class="form-group col-md-6">
                            <label>Expire Date</label>
                            <input type="date" name="expire_date" class="form-control" >

                            @if($errors->has('expire_date'))
                            <span class="small text-danger">
                                {{ $errors->first('expire_date') }}
                            </span>
                            @endif
                        </div>

                       
                    </div>

                    

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Max Limit</label>
                            <input type="number" name="max_limit" class="form-control">

                            @if($errors->has('max_limit'))
                            <span class="text-danger small">
                                {{ $errors->first('max_limit') }}
                            </span>
                            @endif 
                        </div>
                        <div class="form-group col-md-6">
                            <label>Usage Limit / Student</label>
                            <input type="number" name="usage_limit_per_student" class="form-control">

                            @if($errors->has('usage_limit_per_student'))
                            <span class="text-danger small">
                                {{ $errors->first('usage_limit_per_student') }}
                            </span>
                            @endif 
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Discount Percentage</label>
                            <input type="text" name="discount_percentage" class="form-control">

                            @if($errors->has('discount_percentage'))
                            <span class="text-danger small">
                                {{ $errors->first('discount_percentage') }}
                            </span>
                            @endif 
                        </div>
                        <div class="form-group col-md-6">
                            <label>Discount Amount</label>
                            <input type="number" name="discount_amount" class="form-control">

                            @if($errors->has('discount_amount'))
                            <span class="text-danger small">
                                {{ $errors->first('discount_amount') }}
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

                        {{-- <div class="col-md-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="is_ads_available"  >
                                     
                                </label>
                            </div>
                        </div> --}}
                    </div>

                    <div class="form-row mt-4">
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea name="description" rows="4" class="form-control"></textarea>
                        </div>
                    </div>

                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Create Coupon
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
