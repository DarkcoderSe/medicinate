@extends('admin.layouts.master')

@section('title', 'Rewards List')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Rewards List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Rewards List</li>
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
                        <a href="{{ URL::to('admin/reward/create') }} " class="btn btn-success">
                            Add new Reward
                        </a>
                        {{-- add new reward button  --}}
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
                                <th scope="col">Coins</th>
                                <th scope="col">Status</th>
                                <th scope="col">Type</th>
                                <th scope="col">Expiry Date</th>
                                <th scope="col">Redeems</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rewards as $reward)
                            <tr>
                                <td>
                                    <div class="avatar-xs">
                                        <span class="rounded-circle">
                                            <img style="width: 35px;" src="{{ $reward->icon != '' ? URL::to('storage/images/rewards', $reward->icon) : URL::to('admin/assets/images/logo.svg') }}" alt="Logo">
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-14 mb-1">
                                        <a href="{{ URL::to('admin/reward/edit', $reward->id) }}" class="text-dark">
                                            {{ $reward->coins }}
                                        </a>
                                    </h5>
                                </td>
                                <td>
                                    @if($reward->status) 
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else 
                                    <span class="badge badge-pill badge-danger">Not-Active</span>
                                    @endif
                                </td>
                                <td>
                                    @if($reward->is_ads_available)
                                    <span class="badge badge-pill badge-dark">Ads Reward</span>
                                    @else 
                                    <span class="badge badge-pill badge-primary">Daily Reward</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $reward->expire_at }}
                                </td>
                                <td>
                                    {{ $reward->redeems->count() ?? 0 }}x <br>
                                    <a href="{{ URL::to('admin/redeem', $reward->id) }} ">
                                        See in detail
                                    </a>
                                </td>
                                <td>
                                    <ul class="list-inline font-size-20 contact-links mb-0">
                                    
                                        <li class="list-inline-item px-2">
                                            <a class="text-danger" href="{{ URL::to('admin/reward/delete', $reward->id) }} " data-toggle="tooltip" data-placement="top" title="Delete">
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
