@extends('layouts.app')

@section('title', 'Donate a Medicine')

@section('content')

<!-- hero section start -->
<section class="section hero-section bg-ico-hero" id="home" style="padding-bottom: 0 !important;">
    <div class="bg-overlay bg-primary"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="text-white-50">
                    <h1 class="text-white font-weight-semibold mb-3 hero-title">Make an impact</h1>
                    <h4 class="text-white">
                        Lend a helping hand to those in need by donating unused medication or funds to support our work. Your donations stop waste and save lives.
                    </h4>
                    
                </div>
            </div>
            <div class="col-lg-5 col-md-8 col-sm-10 ml-lg-auto">
                <img src="{{ asset('admin/assets/images/homepage1.png') }}" style="width: 400px;" alt="">
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- hero section end -->

<section class="section" style="margin-top: 20px;" id="features">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4 pb-4">
                        <h2>
                            Donation History
                        </h2>
                    </div> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Contact Information
                                </th>
                                <th>
                                    Donation Detail
                                </th>
                                <th>Weight / Cost</th>
                                <th>Medicines List</th>
                                <th>Status</th>
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
                                    {{ $donation->expected_cost }}
                                </td>
                                <td>
                                    @foreach($donation->medicines as $medicine)
                                    <div class="row">
                                        <div class="col-md-4">{{ $medicine->name }} / {{ $medicine->ndc }}</div>
                                        <div class="col-md-4">{{ $medicine->expire_date }} </div>
                                        <div class="col-md-4">{{ $medicine->quantity }} {{ $medicine->quantity_type }} </div>
                                    </div>
                                    @endforeach
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>    
        </div>
    </div>
</div>

</section>
@endsection
