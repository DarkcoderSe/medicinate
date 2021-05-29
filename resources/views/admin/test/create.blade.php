@extends('admin.layouts.master')
{{-- This page shows create page of tests  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Test Create - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Test Create</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/test') }} ">Tests</a></li>
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
                        <a href="{{ URL::to('admin/test') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of test to controller  --}}
                <form action="{{ URL::to('admin/test/submit') }}" enctype="multipart/form-data" method="post">
                    @csrf 
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/test') }}">

               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of test html field  --}}
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input id="name" type="text" name="name" class="form-control" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->has('name'))
                            <span class="small text-danger">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Slug</label>
                            <input id="slug" type="text" name="slug" class="form-control" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->has('slug'))
                            <span class="small text-danger">
                                {{ $errors->first('slug') }}
                            </span>
                            @endif
                        </div>

                        {{-- contact_no of test html field  --}}
                        <div class="form-group col-md-4">
                            <label>Image</label>
                            <input type="file" id="image" name="image" class="form-control" >

                            @if($errors->has('image'))
                            <span class="small text-danger">
                                {{ $errors->first('image') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>Required Coins</label>
                            <input type="number" class="form-control" name="requiredCoins">

                            @if($errors->has('requiredCoins'))
                            <span class="text-danger small">
                                {{ $errors->first('requiredCoins') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label>Required Time ( Minutes )</label>
                            <input type="number" class="form-control" name="requiredTime">

                            @if($errors->has('requiredTime'))
                            <span class="text-danger small">
                                {{ $errors->first('requiredTime') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label>Total Questions</label>
                            <input type="number" name="totalQuestions" class="form-control">
                            @if($errors->has('totalQuestions'))
                            <span class="text-danger small">
                                {{ $errors->first('totalQuestions') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Categories</label>
                            <select name="categoryId" class="custom-select" required>
                                <option value=""> -- chose -- </option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ ($category->id ?? '') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="type"  checked>
                                  Fake
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Create Test
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function(){
        $('#name').on('keyup', function () { 
            let name = $('#name').val().toLowerCase();
            name = name.replace(/ /g, '-');
            $('#slug').val(name);
            console.log(name);
        });
    });
</script>
@endpush

@endsection
