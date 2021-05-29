@extends('admin.layouts.master')

@section('title', 'Question Edit - PrepareHOW')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Question Edit</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    @if(!is_null($question->chapter))
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/chapter/edit', $question->chapter->id) }}">{{ $question->chapter->name }} </a></li>
                    @else 
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/question') }}">Question</a></li>
                    @endif 
                    <li class="breadcrumb-item active">{!! $question->question !!}</li>

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
                        @if(is_null($question->chapter))
                        <a href="{{ URL::to('admin/question') }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a>
                        @else
                        <a href="{{ URL::to('admin/chapter/edit', $question->chapter->id) }}" class="btn btn-primary" style="float: right;">
                            Back
                        </a> 
                        @endif 
                        {{-- back button  --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- creating form to submit data of paymentMethod to controller  --}}
                <form action="{{ URL::to('/admin/question/update') }}" method="post">
                    @csrf 
                    @if(is_null($question->chapter))
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/question') }}">
                    @else  
                    <input type="hidden" name="redirect_to" value="{{ URL::to('admin/chapter/edit', $question->chapter->id) }}">
                    @endif 
                    <input type="hidden" name="id" value="{{ $question->id }}">
               
                    {{-- first row  --}}
                    <div class="form-row">

                        {{-- registration number of paymentMethod html field  --}}
                        <div class="form-group col-md-12">
                            <label>Question</label>
                            <textarea name="question" rows="4" class="form-control" >{{ $question->question }}</textarea>

                            {{-- checking validation errors for above field here  --}}
                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('question') }}
                            </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Explaination</label>
                            <textarea name="explaination" rows="4" class="form-control" >{{ $question->explaination }}</textarea>

                            @if($errors->any())
                            <span class="small text-danger">
                                {{ $errors->first('explaination') }}
                            </span>
                            @endif
                        </div>

                    </div>

                    {{-- saving form data to controller  --}}
                    <button type="submit" class="btn btn-primary mt-3">
                        Update Question
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>
                            Options
                        </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mAddOption">
                          Add Option
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade text-left" id="mAddOption" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Option</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ URL::to('admin/question/option/submit') }}" method="post">
                                            @csrf 
                                            <input type="hidden" name="questionId" value="{{ $question->id }}">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Option</label>
                                                    <textarea name="option" rows="4" class="form-control"></textarea>
                                                    @if($errors->has('option'))
                                                    <span class="red small">
                                                        {{ $errors->first('option') }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                Add Option
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Correct</th>
                            <th>Option</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($question->options as $option)
                        <tr>
                            <td class="text-left">
                                <div class="form-check form-radio-success mb-3">
                    
                                    <input type="radio" name="correctOption" class="question-option form-check-input" id="optionId{{ $option->id }}" value="{{ $option->id }}">

                                </div>
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#mEditOption{{ $option->id }}">
                                {!! $option->value !!}
                                </a>
                                
                                <!-- Modal -->
                                <div class="modal fade text-left" id="mEditOption{{ $option->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Option</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ URL::to('admin/question/option/update') }}" method="post">
                                                    @csrf 
                                                    <input type="hidden" name="id" value="{{ $option->id }}">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label>Option</label>
                                                            <textarea name="option" rows="4" class="form-control">{{ $option->value }}</textarea>
                                                            @if($errors->has('option'))
                                                            <span class="red small">
                                                                {{ $errors->first('option') }}
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">
                                                        Update Option
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td class="text-right">
                                <a href="{{ URL::to('admin/question/option/delete', $option->id) }} " class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="{{ URL::to('admin/assets/js/question.js') }}"></script>
<script>
$(document).ready(function(){
    var questionId = {{ $question->id }};

    $('.question-option').on('change', function(){
        let optionId = $('input[name=correctOption]:checked').val();
        let url = `{{ URL::to('admin/question/option/correct') }}`;
        let token = `{{ csrf_token() }}`;

        let data = {
            optionId: optionId,
            _token: token,
            questionId: questionId
        };

        updateCorrectOption(data, url);
    });
});
</script>
@endpush

@endsection