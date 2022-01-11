@extends('admin.layouts.master')

@section('title', 'Contact View - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Contact View</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $contact->name }}</li>

                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row justify-content-center">
    <div class="col-xl-4 col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Information</h4>
                <div class="text-center">
                    <div class="avatar-sm mx-auto mb-4">
                        @if($contact->status)
                        <span class="avatar-title rounded-circle bg-danger bg-soft font-size-24">
                            <i class="bx bx-user-voice"></i>
                        </span>
                        @else 
                        <span class="avatar-title rounded-circle bg-success bg-soft font-size-24">
                            <i class="bx bx-check"></i>
                        </span>
                        @endif
                    </div>
                    <p class="font-16 text-muted mb-2"></p>
                    <h5 style="text-transform: capitalize;">{{ $contact->name }}</h5>
                    <h6>{{ $contact->contact_no ?? '-' }} | {{ $contact->email ?? '-' }}</h6>

                    <p class="text-muted">
                        {{ $contact->message }}
                    </p>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5">
                        <b>How to respond to positive reviews?</b>
                        <ul>
                            <li>Always personalize the response</li>
                            <li>Always thank the customer</li>
                            <li>Respond to specific points in their review</li>
                            <li>Don’t overstuff your response with keywords</li>
                            <li>Try and offer something of value in your response</li>
                        </ul>
                    </div>
                    <div class="col-md-5 text-center">
                     
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ URL::to('admin/contact') }}" class="btn btn-primary" >
                            Back
                        </a>

                    </div>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ URL::to('admin/contact/update') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $contact->id }}">

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Admin Notes (Response) </label>
                            <textarea name="admin_notes" rows="4" class="form-control">{{ $contact->admin_notes }}</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="status" {{ $contact->status ? '' : 'checked' }}>
                                    Mark as Complete!
                                </label>
                            </div>
                        </div>
                    </div>

                   
                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
