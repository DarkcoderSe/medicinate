@extends('admin.layouts.master')

@section('title', 'Profile - PrepareHow')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Profile</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="card overflow-hidden">
            <div class="bg-soft-primary">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p>It will seem like simplified</p>
                            @php 
                                $user = Auth::user();
                            @endphp 
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="{{ $user->logo_url ?? '' }} " alt="" class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate"> {{ $user->name }} </h5>
                        <p class="text-muted mb-0 text-truncate">{{ $user->roles->first()->name ?? '' }}</p>
                    </div>

                    <div class="col-sm-8">
                        <div class="pt-4">
                            
                            <div class="row">
                                <div class="col-12">
                                    @if($user->phone) <b>Phone: </b> {{ $user->phone }} <br> @endif
                                    @if($user->email) <b>Email: </b> {{ $user->email }} <br> @endif

                                </div>
                                
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>         
    
    <div class="col-lg-8 col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ URL::to('admin/profile') }}" method="post">
                    @csrf 
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            @if($errors->has('name'))
                            <span class="small text-danger">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" required>
                            @if($errors->has('phone'))
                            <span class="small text-danger">
                                {{ $errors->first('phone') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" class="form-control" value="{{ $user->username }}" disabled>
                            
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" value="{{ $user->email }}" class="form-control" disabled>
                            
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Logo URL</label>
                            <input type="text" name="logo_url" class="form-control" value="{{ $user->logo_url }}">
                            @if($errors->has('logo_url'))
                            <span class="small text-danger">
                                {{ $errors->first('logo_url') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Address</label>
                            <input type="text" name="region" class="form-control" value="{{ $user->region }}">
                            @if($errors->has('region'))
                            <span class="small text-danger">
                                {{ $errors->first('region') }}
                            </span>
                            @endif
                        </div>
                       
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="active" {{ $user->active ? 'checked' : '' }} >
                        Active
                      </label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        Submit
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection