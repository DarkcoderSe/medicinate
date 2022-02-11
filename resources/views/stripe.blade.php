@extends('layouts.app')
@section('content')


	<!-- <title>Payment Method</title> -->
    <!-- <link rel="stylesheet" href="css/show_page2.css"> -->

   @push('style')
   <!-- Bootstrap Css -->
   {{-- <!-- <link href="{{asset('admin/assets/css/custom_bootstrap_panel.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" /> --> --}}


   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <style type="text/css">
        /* .container {
            margin-top: 40px !important;
        }
        .panel-heading {
        /* display: inline; */
        font-weight: bold;
        }
        .flex-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 55%;
        } */
    </style>
   @endpush


<!-- hero section start -->
<section class="section hero-section bg-ico-hero" id="home" style="padding-bottom: 0 !important;">
        <div class="bg-overlay bg-primary"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="text-white-50">
                        <h1 class="text-white font-weight-semibold mb-3 hero-title">Donate Amount</h1>
                        <h4 class="text-white">
                        I think people forget that it doesn't take a big donation to help someone, just a lot of little donations.
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




<div class="container" >
    <div class="row">
        <!-- <div class="col-md-6 mx-auto">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row text-center">
                        <h3 class="panel-heading">Payment Details</h3>
                    </div>
                </div>
                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                <form role="form" action="{{ route('stripe.payment') }}" method="post" class="validation"
                    data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-num' size='20'
                                    type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-md-12 hide error form-group'>
                                <div class='alert-danger alert'>Fix the errors before you begin.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-danger btn-lg btn-block" type="submit">Pay Now ($100)</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div> -->

        <div class="col-md-6 mx-auto " style="height: 100vh !important;">
        <div class="card mt-5">
            <div class="card-header h3 bg-success text-white">
            Payment Details
            </div>
            <div class="card-body">
            @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                <form role="form" action="{{ route('stripe.payment') }}" method="post" class="validation"
                    data-cc-on-file="false" data-stripe-publishable-key="pk_test_51KFN2cBT9ZQqIPsmuHKvpGKyGW5wvDjFD6PnsnMQfbYnDlXQidbJSQsM6TzsIBEBTGB0jpayvthG1XfuzbtxLuZh00vI7Bf143" id="payment-form">
                        @csrf

           
                        <div class='form-row row'>
                            <div class='col-12 form-group required'>
                                <label class='control-label'>Name</label> <input
                                    class='form-control' size='4' type='text' maxlength="30" name="name" required>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-12 form-group required'>
                                <label class='control-label'>Email</label> <input
                                    class='form-control' size='4' type='text' maxlength="25" name="email" required>
                            </div>
                        </div>


                        <div class='form-row row'>
                            <div class='col-12 form-group required'>
                                <label class='control-label'>Card Type</label> <input
                                    class='form-control' size='4' type='text' maxlength="10" required>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-num' size='20'
                                    type='text' maxlength="16" required>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4'
                                    type='text' maxlength="3" required>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text' maxlength="2" required>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text' maxlength="4" required> 
                            </div>
                        </div>

                        <div class='col-xs-12 form-group required' required>
                                <label class='control-label'>Select Amount For Donation</label> 
                                <select
                                    class='form-control'   name="amount">
                                <option value="10">£10</option>
                                <option value="20">£20</option>
                                <option value="30">£30</option>
                                <option value="40">£40</option>
                                <option value="50">£50</option>
                                <option value="60">£60</option>
                                <option value="70">£70</option>
                                <option value="80">£80</option>
                                <option value="90">£90</option>
                                <option value="100">£100</option>
                            </select>
                            </div>


                        

                        <div class='form-row row'>
                            <div class='col-md-12 d-none error form-group'>
                                <div class='alert-danger alert'>Fix the errors before you begin.</div>
                            </div>
                        </div>
                        


                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>

                            </div>
                        </div>

                    </form>
            </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
$(function() {
    var $form         = $(".validation");
  $('form.validation').bind('submit', function(e) {
    var $form         = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus = $form.find('div.error'),
        valid         = true;
        $errorStatus.addClass('hide');

        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorStatus.removeClass('hide');
        e.preventDefault();
      }
    });

    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        amount: $('.amount').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeHandleResponse);
    }
    
  });

  function stripeHandleResponse(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>


@endsection