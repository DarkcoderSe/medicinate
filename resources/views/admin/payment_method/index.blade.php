@extends('admin.layouts.master')

{{-- This page shows the list of paymentMethods  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Payment Methods List')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Payment Methods List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Payment Methods List</li>
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
                        <a href="{{ URL::to('admin/payment-method/create') }} " class="btn btn-success">
                            Add new Payment Method
                        </a>
                        {{-- add new paymentMethod button  --}}
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
                                <th scope="col" style="width: 70px;">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paymentMethods as $paymentMethod)
                            <tr>
                                <td>
                                    <div class="avatar-xs">
                                        <span class="rounded-circle">
                                            <img style="width: 35px;" src="{{ $paymentMethod->image != '' ? URL::to('storage/images/payment_methods', $paymentMethod->image) : URL::to('admin/assets/images/logo.svg') }}" alt="Logo">
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-14 mb-1">
                                        <a href="{{ URL::to('admin/payment-method/edit', $paymentMethod->id) }}" class="text-dark">
                                            {{ $paymentMethod->name }}
                                        </a>
                                    </h5>
                                </td>
                                <td>{{ $paymentMethod->status ? 'Active' : 'Not-Active' }} </td>
                                <td>{{ $paymentMethod->type ? 'Live' : 'Sandbox' }} </td>
                                <td>
                                    <ul class="list-inline font-size-20 contact-links mb-0">
                                    
                                        <li class="list-inline-item px-2">
                                            <a class="text-danger" href="{{ URL::to('admin/payment-method/delete', $paymentMethod->id) }} " data-toggle="tooltip" data-placement="top" title="Delete"><i class="bx bx-trash"></i></a>
                                        
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
