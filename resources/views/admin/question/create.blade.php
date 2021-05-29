@extends('admin.layouts.master')
{{-- This page shows create page of questions  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Question Create - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Question Create</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    @if(!is_null($chapter))
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/chapter/edit', $chapter->id) }}">{{ $chapter->name }} </a></li>
                    @else 
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/question') }}">Question</a></li>
                    @endif 
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
                        @if(is_null($chapter))
                        <a href="{{ URL::to('admin/question') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        @else
                        <a href="{{ URL::to('admin/chapter/edit', $chapter->id) }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a> 
                        @endif 
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of paymentMethod to controller  --}}
                <form action="{{ URL::to('/admin/question/submit') }}" method="post">
                    @csrf 
                    @if(is_null($chapter))
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/question') }}">
                    @else  
                    <input type="hidden" name="chapId" value="{{ $chapter->id }}">
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/chapter/edit', $chapter->id) }}">
                    @endif 
               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of paymentMethod html field  --}}
                        <div class="form-group col-md-12">
                            <label>Question</label>
                            <textarea name="question" rows="4" class="form-control" ></textarea>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('question') }}
                            </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Explaination</label>
                            <textarea name="explaination" rows="4" class="form-control" ></textarea>

                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('explaination') }}
                            </span>
                            @endif
                        </div>

                    </div>

                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Create Question
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
