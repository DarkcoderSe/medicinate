@extends('layouts.app')

@section('content')


<!-- <form method="POST" action='{{ URL::to("payment/{$product->id}/purchase") }}' class="card-form mt-3 mb-3">
    @csrf
    <input type="hidden" name="payment_method" class="payment-method">
    <input class="StripeElement mb-3" name="card_holder_name" placeholder="Card holder name" required>
    <div class="col-lg-4 col-md-6">
        <div id="card-element"></div>
    </div>
    <div id="card-errors" role="alert"></div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary pay">
            Purchase
        </button>
    </div>
</form>

 -->

<!-- @section('styles')

<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    let stripe = Stripe("{{ env('STRIPE_KEY') }}")
    let elements = stripe.elements()
    let style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    }
    let card = elements.create('card', {style: style})
    card.mount('#card-element')
    let paymentMethod = null
    $('.card-form').on('submit', function (e) {
        $('button.pay').attr('disabled', true)
        if (paymentMethod) {
            return true
        }
        stripe.confirmCardSetup(
            "{{ $intent->client_secret }}",
            {
                payment_method: {
                    card: card,
                    billing_details: {name: $('.card_holder_name').val()}
                }
            }
        ).then(function (result) {
            if (result.error) {
                $('#card-errors').text(result.error.message)
                $('button.pay').removeAttr('disabled')
            } else {
                paymentMethod = result.setupIntent.payment_method
                $('.payment-method').val(paymentMethod)
                $('.card-form').submit()
            }
        })
        return false
    })
</script> -->


<!-- @endsection -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" type="text/css" href="css/show_page.css">
     <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
     <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Payment Details</title>
</head>
<body>

    <div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card mx-auto">
                <p class="heading">PAYMENT DETAILS</p>
                <form class="card-details " method="POST" 
                action='{{ URL::to("payment/{$product->id}/purchase") }}'>
                    @csrf
                     <input type="hidden" name="payment_method" class="payment-method">
                     <div class="form-group">
                        <div id="card-element"></div>
                    </div>


                    <div class="form-group mb-0">
                        <p class="text-warning mb-0">Card Number</p> <input type="text" name="card_num" placeholder="1234 5678 9012 3457" size="17" id="cno" minlength="19" maxlength="19"> <img src="https://img.icons8.com/color/48/000000/visa.png" width="64px" height="60px" />
                    </div>
                    <div class="form-group">
                        <p class="text-warning mb-0">Cardholder's Name</p> <input type="text" name="name" placeholder="Name" size="17">
                    </div>
                    <div class="form-group pt-2">
                        <div class="row d-flex">
                            <div class="col-sm-4">
                                <p class="text-warning mb-0">Expiration</p> <input type="text" name="exp" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7">
                            </div>
                            <div class="col-sm-3">
                                <p class="text-warning mb-0">Cvc</p> <input type="password" name="cvc" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3">
                            </div>
                            <div class="col-sm-5 pt-0"> <button type="submit" class="btn btn-primary">Payment</button> </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    let stripe = Stripe("{{ env('STRIPE_KEY') }}")
    let elements = stripe.elements()
    let style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    }
    let card = elements.create('card', {
    	fields: {
    		billing_details: {
    			card_num: 'null'
    			name: 'null'
    			exp:'null'
    			cvc:'null'
    		}
    	}
    });

    card.mount('#card-element')
    let paymentMethod = null
    $('.card-details').on('submit', function (e) {
        $('button.pay').attr('disabled', true)
        if (paymentMethod) {
            return true
        }
        stripe.confirmCardSetup(
            "{{ $intent->client_secret }}",
            {
                payment_method: {
                    card: card,
                    billing_details: {card_num: $('.card_num').val()
                						name: $('.name').val()
                						exp: $('.exp').val()
                						cvc: $('.cvc').val()}
                }
            }
        ).then(function (result) {
            if (result.error) {
                $('#card-errors').text(result.error.message)
                $('button.pay').removeAttr('disabled')
            } else {
                paymentMethod = result.setupIntent.payment_method
                $('.payment-method').val(paymentMethod)
                $('.card-details').submit()
            }
        })
        return false
    })
</script>

</body>
</html>


@endsection