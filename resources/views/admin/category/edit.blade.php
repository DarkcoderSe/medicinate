@extends('admin.layouts.master')
{{-- This page shows create page of categorys  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Category Edit - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Category Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/category') }} ">Categories</a></li>
                    <li class="breadcrumb-item active">{{ $category->name }}</li>

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
                        <a href="{{ URL::to('admin/category') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of category to controller  --}}
                <form id="mainFromCreate" action="{{ URL::to('admin/category/update') }}" enctype="multipart/form-data" method="post">
                    @csrf 
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/category') }}">
                    <input type="hidden" name="id" value="{{ $category->id }}">
               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of category html field  --}}
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $category->name }}" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Slug</label>
                            <input id="slug" type="text" name="slug" class="form-control" value="{{ $category->slug }}" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('slug') }}
                            </span>
                            @endif
                        </div>

                        {{-- contact_no of category html field  --}}
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

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Required Coins</label>
                            <input type="text" class="form-control" name="requiredCoins" value="{{ $category->required_coins }}">

                            @if($errors->has('requiredCoins'))
                            <span class="text-danger small">
                                {{ $errors->first('requiredCoins') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Parent Category</label>
                            <select name="parentId" class="custom-select">
                                <option value=""> -- chose -- </option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ ($category->parent_id ?? '') == $cat->id ? 'selected' : '' }}>
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
                                  <input type="checkbox" class="form-check-input" name="status"  {{ $category->status ? 'Checked' : '' }}>
                                  Active
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Update Category
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3 pt-4 mt-4">
        <img src="{{ URL::to('storage/images/categories', $category->image) }}" alt="" class="w-100 mt-2">
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
