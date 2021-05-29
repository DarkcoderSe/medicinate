@extends('admin.layouts.master')

@section('title', 'Referrals History')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Referrals History</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Referrals History</li>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table id="referralTable" class="table table-centered table-nowrap table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Referral Activity Log</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date/Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($referrals as $referral)
                            <tr>
                                <td>
                                    {{ $referral->refBy->name ?? 'User 1' }} has referred
                                    {{ $referral->refTo->name ?? 'User 2' }} and earned 
                                    {{ $referral->ref_received_coins }} coins.
                                </td>
                                <td>
                                    @if($referral->status)
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else 
                                    <span class="badge badge-pill badge-danger">Not-Active</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $referral->created_at }}
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

@push('script')
<script>
    $(document).ready(function(){
        $('#referralTable').DataTable();
    });
</script>
@endpush
