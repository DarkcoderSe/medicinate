@extends('layouts.app')

@section('title', 'Donate a Amount')

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
                                    Nhs Donate
                                </h2>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Medicine Name</th>
                                    <th>Expire Date</th>
                                    <th>NDC</th>
                                    <th>Donate Company Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dms as $dm )
                                    <tr>
                                        <td>{{$dm->name}}</td>
                                        <td>{{$dm->expire_date}}</td>
                                        <td>{{$dm->ndc}}</td>
                                        <td>{{$dm->nhs->name}}</td>
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
