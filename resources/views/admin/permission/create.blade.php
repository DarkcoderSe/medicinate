@extends('admin.layouts.master')
{{-- This page shows create page of permissions  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Permission Create - eNigran')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Permission Create</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/permission') }} ">Permissions</a></li>
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
                        <a href="{{ URL::to('admin/permission') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of permission to controller  --}}
                <form id="mainFromCreate" action="{{ URL::to('admin/permission/submit') }} " method="post">
                    @csrf 
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/permission') }} ">
                
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of permission html field  --}}
                        <div class="form-group col-md-4">
                            <label>Display Name</label>
                            <input type="text" name="display_name" id="dname" class="form-control" required>

                         
                        </div>

                        {{-- contact_no of permission html field  --}}
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text" id="name" name="name" id="name" class="form-control" required>

                        </div>

                    </div>

     

                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary">
                        Create Permission 
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function(){
        $('#dname').on('keyup', function(){
            let name = $('#dname').val().toLowerCase().replace(' ', '-');
            $('#name').val(name);
        });
    });
</script>
@endpush
@endsection
