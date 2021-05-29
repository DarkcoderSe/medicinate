@extends('admin.layouts.master')

@section('title', 'Badge Create - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Badge Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/badge') }}">Badge</a></li>
                    <li class="breadcrumb-item active">{{ $badge->name }}</li>

                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4 text-center">
                     
                    </div>
                    <div class="col-md-4">
                        <a href="{{ URL::to('admin/badge') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of paymentMethod to controller  --}}
                <form action="{{ URL::to('admin/badge/update') }}" enctype="multipart/form-data" method="post">
                    @csrf 

                    <input type="hidden" name="id" value="{{ $badge->id }}">
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/badge') }}">

               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of paymentMethod html field  --}}
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $badge->name }}" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>

                        {{-- contact_no of paymentMethod html field  --}}
                        <div class="form-group col-md-4">
                            <label>Icon</label>
                            <input type="file" id="image" name="icon" class="form-control" >

                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('icon') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Required Donations</label>
                            <input type="number" name="requiredTest" class="form-control" value="{{ $badge->required_test }}" min="0" required>

                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('requiredTest') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea name="description" cols="30" rows="5" class="form-control">{{ $badge->description }}</textarea>
                        </div>
                    </div>

                    
                    <div class="form-row">
                        <div class="col-md-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="status" {{ $badge->status ? 'checked' : '' }}>
                                  Active
                                </label>
                            </div>
                        </div>
                        
                    </div>
                   
                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Update badge
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-3 mt-4 pt-4">
        <img src="{{ URL::to('storage/images/badges', $badge->icon) }}" alt="Image Not Found!" class="w-100 mt-2">
    </div>

</div>
@endsection
