@extends('admin.layouts.master')
{{-- This page shows create page of paymentMethods  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Payment Method Edit - eNigran')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Payment Method Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/payment-method') }} ">Payment Methods</a></li>
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
                        <a href="{{ URL::to('admin/payment-method') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of paymentMethod to controller  --}}
                <form id="mainFromCreate" action="{{ URL::to('admin/payment-method/update') }}" enctype="multipart/form-data" method="post">
                    @csrf 
                    <input type="hidden" name="id" value="{{ $paymentMethod->id }}">
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/payment-method') }}">
               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of paymentMethod html field  --}}
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $paymentMethod->name }}" required>

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
                            <input type="file" id="image" name="image" class="form-control">

                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('image') }}
                            </span>
                            @endif
                        </div>


                    </div>



                    <div class="form-row mb-3">
                        <div class="col-md-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="status" {{ $paymentMethod->status ? 'checked' : '' }}>
                                  Active
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="type" {{ $paymentMethod->type ? 'checked' : '' }}>
                                  Live
                                </label>
                            </div>
                        </div>
                    </div>
                

                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary">
                        Update Payment Method
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <h5>
                            Payment Method Detail
                        </h5>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createKeys">
                          Add Detail
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade text-left" id="createKeys" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Payment Method Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.payment-method.detail.submit') }}" method="post">
                                            <input type="hidden" name="payment_method_id" value="{{ $paymentMethod->id }}">
                                            @csrf 
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Secret Key <span class="text-danger">*</span> </label>
                                                    <input type="text" name="secret_api" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Public Key <span class="text-danger">*</span> </label>
                                                    <input type="text" name="public_api" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Env</label>
                                                    <select name="extra" class="custom-select">
                                                        <option value="live">Live</option>
                                                        <option value="sandbox">Sandbox</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success">
                                                Add Keys 
                                            </button>
                                            
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Secret Key</th>
                            <th>Public Key</th>
                            <th>Extra</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($paymentMethod->detail->count() > 0)
                        @foreach($paymentMethod->detail as $key)
                        <tr>
                            <td>{{ $key->private_key }} </td>
                            <td>{{ $key->public_key }} </td>
                            <td>{{ $key->name }} </td>
                            <td>
                                <a href="{{ URL::to('/admin/payment-method/detail/delete', $key->id) }} " class="btn btn-danger btn-sm">
                                    Delete <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
