@extends('admin.layouts.master')

@section('title', 'Donation List')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Donation List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Donation List</li>
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
                    <div class="col-md-4 text-left">
                        <a href="{{ URL::to('admin/donation/create') }} " class="btn btn-success" >
                            Make a Donation
                        </a>
                    </div>
                    <div class="col-md-4 text-center">

                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ URL::to('admin/home') }} " class="btn btn-primary" >
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="contactTable" class="table table-centered table-nowrap table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    Contact Information
                                </th>
                                <th>
                                    Donation Detail
                                </th>
                                <th>Weight / Cost</th>
                                <th>Medicines List</th>
                                <th>Donate to</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donations as $donation)
                            <tr>
                                <td>
                                    <b>{{ $donation->name }}</b> <br>
                                    <span class="text-muted">
                                        {{ $donation->email }}
                                    </span> <br>
                                    {{ $donation->address }}
                                </td>
                                <td>
                                    <ul>
                                        <li> {{ $donation->is_not_controlled_substance ? 'Is Not a Controlled Substance' : 'Controlled Substance' }} </li>
                                        <li> {{ $donation->not_expire_in_5_month ? 'Will Not Expire In 5 months' : 'Will Expire Within 5 months' }} </li>
                                        <li> {{ $donation->sealed_packaging ? 'Sealed Packaging' : 'Not In Sealed Packaging' }} </li>
                                        <li> {{ $donation->not_require_refrigeration ? 'Not Require Refrigeration' : 'Required Refrigeration' }} </li>
                                        <li> {{ $donation->shipping_paid ? 'Shipping charges are paid' : 'Not Paid Shipping charges' }} </li>

                                    </ul>
                                </td>
                                <td>
                                    {{ $donation->donation_weight }} {{ $donation->donation_weight_standard }} /
                                    Rs. {{ $donation->expected_cost }}
                                </td>
                                <td>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#md{{$donation->id}}">
                                        Donated Medicines
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="md{{$donation->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Donated Medicies List</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <table class="table table-striped m-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Name & Strength</th>
                                                                <th>NDC</th>
                                                                <th>Expire Date</th>
                                                                <th>Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($donation->medicines as $medicine)
                                                            <tr>
                                                                <td>{{ $medicine->name }}</td>
                                                                <td>{{ $medicine->ndc }}</td>
                                                                <td>{{ $medicine->expire_date }} </td>
                                                                <td>{{ $medicine->quantity }} {{ $medicine->quantity_type }} </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>

                                    <form action="{{ URL::to('admin/donation/update') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $donation->id }}">
                                        <select name="ngos[]" multiple>
                                            @if(!is_null($ngos))
                                                @foreach($ngos as $ngo)
                                                <option value="{{ $ngo->id }}" {{ $donation->ngos->where('id', $ngo->id)->count() > 0 ? 'selected' : '' }}>
                                                    {{ $ngo->name ?? '' }}
                                                </option>
                                                @endforeach
                                            @endif
                                            </select> <br>
                                            <button type="submit" class="btn btn-primary btn-sm mt-2">
                                                Update NGOs
                                            </button>

                                    </form>

                                </td>
                                <td>
                                    @if ($donation->status == 0)
                                    <span class="text-warning">
                                        Haven't Received By Staff Yet
                                    </span>
                                    @elseif($donation->status == 1)
                                    <span class="text-success">
                                        Your Donation is Received Successfully
                                    </span>
                                    @elseif($donation->status == 2)
                                    <span class="text-danger">
                                        Your donation was fake and Canceled
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if($donation->status == 0)
                                    <a href="{{ URL::to('admin/donation/status/1', $donation->id) }} " class="btn btn-success btn-sm">Accept</a>
                                    <a href="{{ URL::to('admin/donation/status/2', $donation->id) }} " class="btn btn-danger btn-sm">Reject</a>
                                    @endif

                                    @if($donation->status == 2)
                                    <a href="{{ URL::to('admin/donation/delete', $donation->id) }}" class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                    @endif
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
