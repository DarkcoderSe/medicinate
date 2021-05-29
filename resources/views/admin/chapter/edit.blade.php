@extends('admin.layouts.master')

@section('title', 'Chapter Edit - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Chapter Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    @if(!is_null($chapter->subject))
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('/admin/chapter') }} ">{{ $chapter->subject->name ?? '' }}</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active">{{ $chapter->name }}</li>

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
                    <div class="col-md-4 text-right">
                        @if(!is_null($chapter->subject))
                        <a href="{{ URL::to('admin/subject/edit', $chapter->subject->id) }}" class="btn btn-primary" >
                            Back
                        </a>
                        @else 
                        <a href="{{ URL::to('admin/chapter') }}" class="btn btn-primary" >
                            Back
                        </a>
                        @endif
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">

                <form id="mainFromCreate" action="{{ URL::to('admin/chapter/update') }}" enctype="multipart/form-data" method="post">
                    @csrf 
                    
                    @if(!is_null($chapter->subject))
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/subject/edit', $chapter->subject->id) }}">
                    @endif
                    <input type="hidden" name="id" value="{{ $chapter->id }}">

               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of paymentMethod html field  --}}
                        <div class="form-group col-md-8">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $chapter->name }}" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>
                       
                    </div>

                   
                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Update Chapter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
