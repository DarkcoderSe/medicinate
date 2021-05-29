@extends('admin.layouts.master')
{{-- This page shows create page of subjects  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Subject Create - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Subject Create</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/subject') }} ">Subject</a></li>
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
                        <a href="{{ URL::to('admin/subject') }}" class="btn btn-primary" style="float: right;">
                            <i class="fa fa-angle-left"></i> Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of paymentMethod to controller  --}}
                <form id="mainFromCreate" action="{{ URL::to('admin/subject/update') }}" enctype="multipart/form-data" method="post">
                    @csrf 
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/subject') }}">
                    <input type="hidden" name="id" value="{{ $subject->id }}">
               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of paymentMethod html field  --}}
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $subject->name }}" required>

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
                            <input type="file" id="image" name="image" class="form-control" >

                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('image') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Coins per Question</label>
                            <input type="number" name="coinsPerQuestion" class="form-control" value="{{ $subject->coins_per_question }}" min="1" max="99999" required>

                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('coinsPerQuestion') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea name="description" cols="30" rows="5" class="form-control">{{ $subject->description }}</textarea>
                        </div>
                    </div>

                   
                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Update Subject
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
                    <div class="col-md-6">
                        <h3>
                            {{ $subject->name }}'s Chpaters
                        </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mChapter">
                            <i class="fa fa-pencil-alt"></i> Create Chapter
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade text-left" id="mChapter" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> 
                                            Add New Chapter in {{ $subject->name }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ URL::to('admin/chapter/submit') }}" method="post">
                                            @csrf 
                                            <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                                            <input type="hidden" name="redirect_to" value="{{ URL::to('/admin/subject/edit', $subject->id) }}">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" required>
                                                    
                                                </div>
                                            </div>
        
                                            <button class="btn btn-primary" type="submit">
                                                Add
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
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subject->chapters as $chapter)
                        <tr>
                            <td> 
                                <a href="{{ URL::to('admin/chapter/edit', $chapter->id) }}"> 
                                    {{ $chapter->name }} <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ URL::to('admin/chapter/delete', $chapter->id) }} " class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
