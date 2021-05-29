@extends('admin.layouts.master')

@section('title', 'Coupons List')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Coupons List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Coupons List</li>
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
                        <a href="{{ URL::to('admin/coupon/create') }} " class="btn btn-success">
                            Add new Coupon
                        </a>
                        {{-- add new coupon button  --}}
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
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Description</th>
                                <th scope="col">Expire Date</th>
                                <th scope="col">Discounts</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                            <tr>
                                <td>
                                    <h5 class="font-size-14 mb-1">
                                        <a href="{{ URL::to('admin/coupon/edit', $coupon->id) }}" class="text-dark">
                                            {{ $coupon->code }}
                                        </a>
                                    </h5>
                                </td>
                                <td>
                                    {!! $coupon->description !!}
                                </td>
                                <td>
                                    {{ $coupon->expire_date }}
                                </td>
                                <td>
                                    @if($coupon->discount_percentage)
                                    <b>Discount Percentage : </b> {{ $coupon->discount_percentage }}
                                    @endif
                                    @if($coupon->discount_amount)
                                    <b>Discount Amount : </b> {{ $coupon->discount_amount }}
                                    @endif
                                </td>
                                <td>
                                    @if($coupon->status) 
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else 
                                    <span class="badge badge-pill badge-danger">Not-Active</span>
                                    @endif
                                </td>
                                
                                <td>
                                    <ul class="list-inline font-size-20 contact-links mb-0">
                                    
                                        <li class="list-inline-item px-2">
                                            <a class="text-danger" href="{{ URL::to('admin/coupon/delete', $coupon->id) }} " data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </a>
                                        </li>
                                    </ul>
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
