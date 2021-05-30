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
                            Ready to donate?
                        </h2>
                        <span class="text-danger">
                        Donated medicine must meet ALL of these criteria.
                        </span>
                    </div> 

                    <form action="{{ route('donation.submit') }}" method="post">
                        @csrf 
                        <div class="custom-control custom-checkbox custom-checkbox-outline custom-checkbox-primary mb-3">
                            <input type="checkbox" class="custom-control-input" name="is_not_controlled_substance" id="is_not_controlled_substance">
                            <label class="custom-control-label" for="is_not_controlled_substance">Is not a Controlled Substance</label>
                        </div>

                        <div class="custom-control custom-checkbox custom-checkbox-outline custom-checkbox-primary mb-3">
                            <input type="checkbox" class="custom-control-input" name="not_expire_in_5_month" id="not_expire_in_5_month">
                            <label class="custom-control-label" for="not_expire_in_5_month">Will Not Expire in at least 5 months</label>
                        </div>

                        <div class="custom-control custom-checkbox custom-checkbox-outline custom-checkbox-primary mb-3">
                            <input type="checkbox" class="custom-control-input" name="sealed_packaging" id="sealed_packaging">
                            <label class="custom-control-label" for="sealed_packaging">Is in Sealed Packaging</label>
                        </div>

                        <div class="custom-control custom-checkbox custom-checkbox-outline custom-checkbox-primary mb-3">
                            <input type="checkbox" class="custom-control-input" name="not_require_refrigeration" id="not_require_refrigeration">
                            <label class="custom-control-label" for="not_require_refrigeration">Will Not Require Any Refrigeration</label>
                        </div>

                        <div class="custom-control custom-checkbox custom-checkbox-outline custom-checkbox-primary mb-3">
                            <input type="checkbox" class="custom-control-input" name="shipping_paid" id="shipping_paid">
                            <label class="custom-control-label" for="shipping_paid">Shipping chages Paid</label>
                        </div>

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
                                <label>Address</label>
                                <textarea name="address" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>

                        

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <hr>
                                <h4>List of Donated Medicines</h4>
                            </div>
                        </div>

                        <div id="md-rows">
                            <div class="form-row mt-4" id="md-row1">
                                <div class="form-group col-md-3">
                                    <label>Medicine Name & Strength <span class="text-danger">*</span> </label>
                                    <input type="text" name="drugName[]" class="form-control form-control-sm" required>
                                </div>
    
                                <div class="form-group col-md-2">
                                    <label>National Drug Code <span class="text-danger">*</span> </label>
                                    <input type="string" name="ndc[]" class="form-control form-control-sm" required>
                                </div>
    
                                <div class="form-group col-md-2">
                                    <label>Expire Date <span class="text-danger">*</span> </label>
                                    <input type="date" name="expire_date[]" class="form-control form-control-sm" required> 
                                </div>
    
                                <div class="form-group col-md-2">
                                    <label>Quantity <span class="text-danger">*</span> </label>
                                    <input type="text" name="quantity[]" class="form-control form-control-sm" required>
                                </div>
    
                                <div class="form-group col-md-2">
                                    <label>Quantity Type</label>
                                    <input type="text" name="quantity_type[]" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-sm" id="addAnotherItem">
                                    + Add Another Item
                                </button>
                            </div>
                        </div>

                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Donation Weight <span class="text-danger">*</span> </label>
                                <input type="text" name="donation_weight" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Donation Weight Standard</label>
                                <input type="text" name="donation_weight_standard" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Expected Cost</label>
                                <input type="text" name="expected_cost" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12 text-right">
                                <button class="btn btn-primary" style="width: 150px;" type="submit">Donate</button>
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

@push('script')
<script>
    function removeCurrentRow(ele) {
        ele.parentElement.parentElement.remove();
    }

    var row = 1;
    $(document).ready(function() {
        $('#addAnotherItem').on('click', function() {

            let item = $('#md-row1').html();
            // console.log(item);
            row++;
            let itemCom = `<div class="form-row mt-4" id="md-row${row}">
                            ${item}
                            <div class='form-group col-md-1 mt-4 pt-1'>
                                <button onclick="removeCurrentRow(this);" type="button" class="btn btn-danger btn-sm">
                                    &times;
                                </button>
                            </div>
                           </div>`;
            $('#md-rows').append(itemCom);
        });
    });

    

</script>
@endpush