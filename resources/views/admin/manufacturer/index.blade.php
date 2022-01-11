@extends('admin.layouts.master')

@section('title', 'Manufacturers List')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Manufacturers List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manufacturers List</li>
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

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                          Add New Manufacturer
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Manufacturer Record</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ URL::to('admin/manufacturer/submit') }} " method="post">
                                            @csrf 
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Name</label>
                                                    <input type="text" name="name" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>DMLN</label>
                                                    <input type="text" name="dmln" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Type Of License</label>
                                                    <input type="text" name="type_of_license"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Address</label>
                                                    <textarea name="address" id="" cols="30" rows="4" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                        {{-- add new manufacturer button  --}}
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
                                <th scope="col">Name</th>
                                <th scope="col">Dmln</th>
                                <th scope="col">Type of License</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($manufacturers as $manufacturer)
                            <tr>
                                <td>
                                    <h5 class="font-size-14 mb-1">
                                        {{-- <a href="{{ URL::to('admin/manufacturer/edit', $manufacturer->id) }}" class="text-dark"> --}}
                                            {{ $manufacturer->name }}
                                        {{-- </a> --}}
                                    </h5>
                                </td>
                                <td>
                                    {{ $manufacturer->dmln }}
                                </td>
                                <td>
                                    {{ $manufacturer->type_of_license }}
                                </td>
                                <td>
                                    {!! $manufacturer->address !!}
                                </td>
                                <td>
                                    <ul class="list-inline font-size-20 contact-links mb-0">
                                    
                                        <li class="list-inline-item px-2">
                                            <a class="text-danger" href="{{ URL::to('admin/manufacturer/delete', $manufacturer->id) }} " data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </a>
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
