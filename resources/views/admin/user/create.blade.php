@extends('admin.layouts.master')
{{-- This page shows create page of users  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Student Create - eNigran')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Student Create</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/user') }}">Students</a></li>
                    <li class="breadcrumb-item active">Create</li>

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
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4 text-center">
                     
                    </div>
                    <div class="col-md-4">
                        <a href="{{ URL::to('admin/user') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of user to controller  --}}
                <form id="mainFromCreate" action="{{ URL::to('admin/user/submit') }} " method="post" enctype="multipart/form-data">
                    @csrf 
                
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of user html field  --}}
                        <div class="form-group col-md-4">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                            <span class="small text-danger">
                                {{ $errors->first('name') }}
                            </span>
                            @enderror

                        </div>

                        {{-- contact_no of user html field  --}}
                        <div class="form-group col-md-4">
                            <label>Profile</label>
                            <input type="file" name="profile" class="form-control" required>
                            @error('profile')
                            <span class="small text-danger">
                                {{ $errors->first('profile') }}
                            </span>
                            @enderror
                        </div>

                        {{-- reg no of user html field  --}}
                        <div class="form-group col-md-4">
                            <label>Contact No.</label>
                            <input type="text" name="contact_no" class="form-control" {{ old('contact_no') }} required>
                           
                            @error('contact_no')
                            <span class="small text-danger">
                                {{ $errors->first('contact_no') }}
                            </span>
                            @enderror
                        </div>

                    </div>

                    {{-- 2nd row  --}}
                    <div class="form-row">

                        {{-- email of user html field  --}}
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" {{ old('email') }} required>

                            @error('email')
                            <span class="small text-danger">
                                {{ $errors->first('email') }}
                            </span>
                            @enderror
                        </div>

                        {{-- Password of user html field  --}}
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            {{-- setting default password 123456  --}}
                            <input type="text" name="password" class="form-control" value="123456"  required>

                            @error('password')
                            <span class="small text-danger">
                                {{ $errors->first('password') }}
                            </span>
                            @enderror
                        </div>

                    </div>

                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary">
                        Create Student
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $('#username').on('keyup', function(){
            let username = $('#username').val();
            if(username == ''){
                toastr.error('Username must not be empty', 'Required');
                $('#username-valid').html('');
                return false;
            }

            $.get(`{{ URL::to('admin/user/is-valid') }}/${username}`, function(res){
                // console.log(res);
                let message = ``;
                if(res > 0){
                    $('#username-valid').removeClass('text-success');
                    $('#username-valid').addClass('text-danger');
                    $('#username-valid').html('Sorry, Username is not Available!');
                }
                else{
                    $('#username-valid').removeClass('text-danger');
                    $('#username-valid').addClass('text-success');
                    $('#username-valid').html('Congrats, Username is Available!');
                }
            });
        })

        $('#createRoleBtn').on('click', function(){
            let name = $('#name').val();
            
            let displayName = $('#display_name').val();
            let url = `{{ URL::to('admin/role/submit') }}`;
            let token = `{{ csrf_token() }}`;
            
            if(name == ''){
                toastr.error('Please, enter slug name first', 'Required');
                return ;
            }
            if(displayName == ''){
                toastr.error('Please, enter display name', 'Required');
                return ;
            }

            let data = {
                _token: token,
                name : name, 
                display_name : displayName,
                redirect_to: `{{ URL::to('/admin/user/create') }}`
            };

            $.post(url, data, function(res){
                console.log(res);
                let roles = ``;
                res.forEach(role => {
                    roles += `<option value='${role.name}'>${role.display_name}</option>`;
                });

                $('#role').html(roles);
                $('#roleCreate').modal('hide');
                $('#name').val('');
                $('#display_name').val('');
                toastr.success('A new role added successfully', 'Success');
            });

        });
    });
</script>
@endpush
