@extends('admin.layouts.master')

@section('title', 'Make a Donation')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Make a Donation</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/donation') }}">Donation List</a></li>
                    <li class="breadcrumb-item active">New Donation</li>
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


                    <div class="form-row">
                        <div class="form-group col-md-12">

                            <label class="control-label">Select NGOs (Multiple)</label>

                            <select class="select2 form-control select2-multiple" multiple="multiple" name="ngo[]" data-placeholder="Choose ...">
                                <option value="">Any</option>
                                @foreach($ngos as $ngo)
                                <option value="{{ $ngo->id }}">
                                    {{ $ngo->name }}
                                </option>
                                @endforeach
                            </select>

                            <span class="text-muted small">
                                Your donation will goes to selected NGOs only.
                            </span>
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
