@extends('layouts.app')
@section('style')
    <style type="text/css">
        .container {
            margin-top: 40px;
        }
        .panel-heading {
            display: inline;
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
        }
    </style>
@endsection
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

<div class="container p-5">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
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

                    <form role="form" action="{{ route('payment.post') }}" method="post" class="validation"
                          data-cc-on-file="false"
                          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                          id="payment-form">
                        @csrf
                        <div class='form-row row'>
                            <div class='col-xs-6 col-md-6 form-group required'>
                                <label class='control-label'>Name </label> <input
                                    class='form-control'  type='input' name="name">
                            </div>
                            <div class='col-xs-6 col-md-6 form-group required'>
                                <label class='control-label'>Email </label> <input
                                    class='form-control'  type='email' name="email">
                            </div>
                        </div>

{{--                        <div class='form-row row'>--}}
{{--                            <div class='col-xs-6 form-group required'>--}}
{{--                                <label class='control-label'>Name on Card</label> <input--}}
{{--                                    class='form-control'  type='text'>--}}
{{--                            </div>--}}

{{--                        </div>--}}

                        <div class='form-row row'>
                            <div class='col-xs-6 col-md-6 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-num'
                                    type='text' name="cardNumber">
                            </div>
                            <div class='col-xs-6 col-md-6 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415'
                                       type='text' name="cvc">
                            </div>
                        </div>

{{--                        <div class='form-row row'>--}}

{{--                         --}}
{{--                            <div class='col-xs-6 col-md-6 form-group expiration required'>--}}
{{--                                <label class='control-label'>Expiration Year</label> <input--}}
{{--                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'--}}
{{--                                    type='text'>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class='form-row row'>
                            <div class='col-xs-6 col-md-6 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='date' name="expirationDate">
                            </div>
                            <div class='col-xs-6 col-md-6 form-group expiration required'>
                                <label class='control-label'>Amount</label> <select
                                    class='form-control card-expiry-month' placeholder='10$-100$'>
                                <option >$10</option>
                                <option >$20</option>
                                <option >$30</option>
                                <option >$40</option>
                                <option >$50</option>
                                <option >$60</option>
                                <option >$70</option>
                                <option >$80</option>
                                <option >$90</option>
                                <option >$100</option>
                            </select>
                            </div>
                        </div>
{{--                        <div class='form-row row'>--}}
{{--                            <div class='col-md-12 hide error form-group'>--}}
{{--                                <div class='alert-danger alert'>Fix the errors before you begin.</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

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
