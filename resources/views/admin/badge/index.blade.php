@extends('admin.layouts.master')

@section('title', 'Badges List')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Badges List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Badges List</li>
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
                        <a href="{{ URL::to('admin/badge/create') }} " class="btn btn-success">
                            Add new Badge
                        </a>
                        {{-- add new badge button  --}}
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
                                <th scope="col" style="width: 70px;">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Eligibility Criteria</th>
                                <th scope="col">Badge Holders</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($badges as $badge)
                            <tr>
                                <td>
                                    <div class="avatar-xs">
                                        <span class="rounded-circle">
                                            <img style="width: 35px;" src="{{ $badge->icon != '' ? URL::to('storage/images/badges', $badge->icon) : URL::to('admin/assets/images/logo.svg') }}" alt="Logo">
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-14 mb-1">
                                        <a href="{{ URL::to('admin/badge/edit', $badge->id) }}" class="text-dark">
                                            {{ $badge->name }}
                                        </a>
                                    </h5>
                                </td>
                                <td>
                                    {{ $badge->status ? 'Active' : 'Not-Active' }}
                                </td>
                                <td>
                                    @if($badge->required_test != 0)
                                    <b>Required Test : </b> {{ $badge->required_test }} <br>
                                    @endif 
                                    @if($badge->max_score != 0)
                                    <b>Max Score : </b> {{ $badge->max_score }} <br>
                                    @endif 
                                    @if($badge->min_score != 0)
                                    <b>Min Score : </b> {{ $badge->min_score }}
                                    @endif
                                </td>
                                <td>
                                    {{ $badge->students->count() ?? 0 }} Students
                                </td>
                                <td>
                                    <ul class="list-inline font-size-20 contact-links mb-0">
                                    
                                        <li class="list-inline-item px-2">
                                            <a class="text-danger" href="{{ URL::to('admin/badge/delete', $badge->id) }} " data-toggle="tooltip" data-placement="top" title="Delete">
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
