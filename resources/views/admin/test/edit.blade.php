@extends('admin.layouts.master')

@section('title', 'Test Edit - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Test Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/test') }} ">Tests</a></li>
                    <li class="breadcrumb-item active">{{ $test->name }}</li>

                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4 text-center">
                     
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ URL::to('admin/test/question/view', $test->id) }}" class="btn btn-dark">
                            <i class="fa fa-eye"></i> View Questions
                        </a>

                        <a href="{{ URL::to('admin/test') }}" class="btn btn-primary">
                            Back
                        </a>
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of test to controller  --}}
                <form action="{{ URL::to('admin/test/update') }}" enctype="multipart/form-data" method="post">
                    @csrf 
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/test/edit', $test->id) }}">
                    <input type="hidden" name="id" value="{{ $test->id }}">
               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of test html field  --}}
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $test->name }}" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->has('name'))
                            <span class="small text-danger">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Slug</label>
                            <input id="slug" type="text" name="slug" class="form-control" value="{{ $test->slug }}" required>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->has('slug'))
                            <span class="small text-danger">
                                {{ $errors->first('slug') }}
                            </span>
                            @endif
                        </div>

                        {{-- contact_no of test html field  --}}
                        <div class="form-group col-md-4">
                            <label>Image</label>
                            <input type="file" id="image" name="image" class="form-control" >

                            @if($errors->has('image'))
                            <span class="small text-danger">
                                {{ $errors->first('image') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>Required Coins</label>
                            <input type="number" class="form-control" name="requiredCoins" value="{{ $test->required_coins }}">

                            @if($errors->has('requiredCoins'))
                            <span class="text-danger small">
                                {{ $errors->first('requiredCoins') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label>Required Time ( Minutes )</label>
                            <input type="number" class="form-control" name="requiredTime" value="{{ $test->required_time }}">

                            @if($errors->has('requiredTime'))
                            <span class="text-danger small">
                                {{ $errors->first('requiredTime') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label>Total Questions</label>
                            <input type="number" name="totalQuestions" class="form-control" value="{{ $test->total_questions }}">
                            @if($errors->has('totalQuestions'))
                            <span class="text-danger small">
                                {{ $errors->first('totalQuestions') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Categories</label>
                            <select name="categoryId" class="custom-select" required>
                                <option value=""> -- chose -- </option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ ($test->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="type"  {{ $test->type ? 'checked' : '' }}>
                                  Fake
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Update Test
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-3 mt-4 pt-4">
        <img src="{{ URL::to('storage/images/tests', $test->image) }}" alt="Image Not Found!" class="w-100 mt-2">
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h4>
                            Test Questions Rules
                        </h4>
                    </div>
                    <div class="col-md-6 text-right">
                        
                    </div>
                </div>
                @php 
                    $limit = 100 - ($test->testSubjectRules->sum('percentage') ?? 0 );
                @endphp 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Subjects</label>
                                <select id="subjects" class="custom-select">
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">
                                        {{ $subject->name }} ( {{$subject->chapters->count() ?? 0}} Chap )
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Percentage of Questions </label>
                                <input type="text" class="form-control" id="percentageOfQuestions" min="1" max="{{ $limit }}" value="{{ $limit == 0 ? 0 : $limit }}" {{ $limit == 0 ? 'disabled' : '' }}>
                            </div>
                            <div class="form-group col-md-2 pt-1">
                                <button class="btn btn-dark btn-block mt-4" onclick="addQuestionToList();" type="button">
                                    <i class="fa fa-plus"></i> Add to List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <form action="{{ URL::to('admin/test/question/submit') }}" method="post">
                    @csrf
                    <input type="hidden" name="testId" value="{{ $test->id }}">
                    

                    <table class="table table-striped mt-0">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <span class="text-danger" id="remaining">{{ $limit }}</span>% Test Questions capicty remaining
                                </th>
                            </tr>
                            <tr>
                                <th>Subject</th>
                                <th>Percentage</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="subjectList">
                            @foreach($test->testSubjectRules as $testSubjectRule)
                            <tr id="tr{{$testSubjectRule->subject_id}}">
                                <td>
                                    <input class="percentage" type="hidden" name="subject[{{$testSubjectRule->subject_id}}]" value="{{$testSubjectRule->percentage}}">
                                    {{$testSubjectRule->subject->name ?? ''}}
                                </td>
                                <td>{{$testSubjectRule->percentage}}</td>
                                <td>
                                    <a class="text-danger" href="{{URL::to('admin/test/question/delete', $testSubjectRule->id)}}">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    
                    <button type="submit" class="btn btn-success btn">
                        <i class="fa fa-save"></i> Save Rules
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    let removeTableRow = (selector) => {
        let space = Number($(selector)[0].cells[1].innerText);
        $(selector).remove();

        let percentageOfQuestions = Number($('#percentageOfQuestions').val());
        let remaining = Number($('#remaining').text());

        $('#percentageOfQuestions').attr('max', percentageOfQuestions + space);
        $('#percentageOfQuestions').val(percentageOfQuestions + space);
        $('#remaining').text(remaining + space);


    }

    let balanceTheLimit = () => {

    }

    let addQuestionToList = () => {
        let percentageOfQuestions = Number($('#percentageOfQuestions').val());
        let selectedSubject = $('#subjects').val();
        let selectedSubjectName = $('#subjects').find(":selected").text();

        // Validation
        if (percentageOfQuestions == 0) {
            toastr.error('Percentage of questions in Subject cannot be Zero', 'Validation Err!');
            return false;
        }
        if ($(`#tr${selectedSubject}`).length) {
            toastr.error(`${selectedSubjectName} is already in list.`, 'Validation Err!');
            toastr.info('If you want to change the percentage of question then remove old row and add again!', 'NOTE:');
            return false;
        }

        // Generating DOM
        let input = `<input class="percentage" type="hidden" name="subject[${selectedSubject}]" value="${percentageOfQuestions}">`;
        let row = `<tr id="tr${selectedSubject}">
                        <td>${input}${selectedSubjectName}</td>
                        <td>${percentageOfQuestions}</td>
                        <td>
                            <a class="text-danger" href="javascript:void(0)" onclick="removeTableRow('#tr${selectedSubject}');">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>`;

        // Maintaining the physics of universe
        let remaining = Number($('#remaining').text());
        let remainingPercentage = remaining - percentageOfQuestions;
        $('#percentageOfQuestions').attr('max', remainingPercentage);
        if(remainingPercentage == 0)
            $('#percentageOfQuestions').attr('min', 0);
            
        $('#percentageOfQuestions').val(remainingPercentage);
        $('#remaining').text(remainingPercentage);

        $('#subjectList').append(row);
    }

    $(document).ready(function(){

        $('#testQuestions').DataTable();

        $('#name').on('keyup', function () { 
            let name = $('#name').val().toLowerCase();
            name = name.replace(/ /g, '-');
            $('#slug').val(name);
            console.log(name);
        });

    });
</script>
@endpush

@endsection
