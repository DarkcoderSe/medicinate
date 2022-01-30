@extends('admin.layouts.master')

@section('title', 'Payments List')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Payment List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Payment List</li>
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
                    <table id="contactTable" class="table table-centered table-nowrap table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Stripe Detail</th>
                                <th scope="col">Card Last 4 Digits</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date/Time</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->name }} </td>
                                <td>{{ $payment->email }} </td>
                                <td>${{ $payment->amount }} </td>
                                <td>
                                    Charge ID:  {{ $payment->charge_id }} <br>
                                    Tnx ID: {{ $payment->transaction_id }} <br>
                                    <a href="{{ $payment->recipt_url }}">Receipt URL</a>
                                </td>
                                <td>{{ $payment->last4 }} </td>
                                <td>{{ $payment->description }} </td>
                                <td>{{ $payment->created_at }} </td>
                                <td>{{ $payment->stripe_status }} </td>


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
