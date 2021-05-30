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
                    <h1 class="text-white font-weight-semibold mb-3 hero-title">Feedback!</h1>
                    <h4 class="text-white">
                        Have you found any issue, Want a new Feature or Appriciate the Team?
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
                            Feedback Form
                        </h2>
                    </div> 

                    <form action="{{ route('feedback.submit') }}" method="post">
                        @csrf 

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name <span class="text-danger">*</span> </label>
                                <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email <span class="text-danger">*</span> </label>
                                <input type="text" name="email" value="{{ auth()->user()->email ?? '' }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Contact No</label>
                                <input type="text" name="contact_no" value="{{ auth()->user()->contact_no ?? '' }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Message</label>
                                <textarea name="message" cols="30" rows="4" class="form-control" required></textarea>
                            </div>
                        </div>

                        
                        <div class="form-row">
                            <div class="form-group col-md-12 text-right">
                                <button class="btn btn-primary" style="width: 150px;" type="submit">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>    
        </div>
    </div>
</div>

</section>
@endsection
