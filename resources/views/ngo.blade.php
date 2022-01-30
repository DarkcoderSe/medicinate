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
                    <h1 class="text-white font-weight-semibold mb-3 hero-title">NGO</h1>
                    <h4 class="text-white">
                        We will donate to these Non Govt Organization only. 
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
                            Non Govt Organizations
                        </h2>
                    </div> 

                    <ul>
                        @foreach($ngos as $ngo)
                        <li>{{ $ngo->name ?? '' }} </li>
                        @endforeach
                    </ul>
                </div>
            </div>    
        </div>
    </div>
</div>

</section>
@endsection
