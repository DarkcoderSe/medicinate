@extends('admin.layouts.master')

@section('title', 'Reward Edit - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Reward Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/reward') }}">Rewards</a></li>
                    <li class="breadcrumb-item active">{{ $reward->coins . ' Coins Edit' }}</li>

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
                        <a href="{{ URL::to('admin/reward') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of paymentMethod to controller  --}}
                <form action="{{ URL::to('admin/reward/update') }}" enctype="multipart/form-data" method="post">
                    @csrf 
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/reward') }}">

                    <input type="hidden" name="id" value="{{ $reward->id }}">
               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of paymentMethod html field  --}}
                        <div class="form-group col-md-4">
                            <label>Coins</label>
                            <input type="text" name="coins" class="form-control" value="{{ $reward->coins }}" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->has('coins'))
                            <span class="small text-danger">
                                {{ $errors->first('coins') }}
                            </span>
                            @endif
                        </div>

                        {{-- contact_no of paymentMethod html field  --}}
                        <div class="form-group col-md-4">
                            <label>Icon</label>
                            <input type="file" id="image" name="icon" class="form-control" >

                            @if($errors->has('icon'))
                            <span class="small text-danger">
                                {{ $errors->first('icon') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Limit</label>
                            <input type="number" name="limit" class="form-control" min="0" required value="{{ $reward->limit }}">

                            @if($errors->has('limit'))
                            <span class="small text-danger">
                                {{ $errors->first('limit') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Expire Date</label>
                            <input type="date" name="expire_at" value="{{ $reward->expire_at }}" class="form-control">

                            @if($errors->has('expire_at'))
                            <span class="text-danger small">
                                {{ $errors->first('expire_at') }}
                            </span>
                            @endif 
                        </div>
                        <div class="form-group col-md-6">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control" value="{{ $reward->order }}">

                            @if($errors->has('order'))
                            <span class="text-danger small">
                                {{ $errors->first('order') }}
                            </span>
                            @endif 
                        </div>
                    </div>

                   
                    <div class="form-row">
                        <div class="col-md-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="status"  {{ $reward->status ? 'checked' : '' }}>
                                    Active
                                </label>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="is_ads_available" {{ $reward->is_ads_available ? 'checked' : '' }}>
                                    Ads Available 
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row mt-4">
                        <div class="form-group col-md-12">
                            <label>Ad ( Source code )</label>
                            <textarea name="ad" cols="30" rows="5" class="form-control">{{ $reward->ad }}</textarea>
                        </div>
                    </div>

                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Update Reward
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
