@extends('admin.layouts.master')

{{-- This page shows the list of questions  --}}
{{-- tihs page's parent is layout > master  --}}
{{-- we use @ for blade syntax and $ for php  --}}
@section('title', 'Random Questions List')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Random Questions List ({{$questions->count()}}) </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Random Questions List</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table id="questionTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Question</th>
                                <th scope="col">Chapter</th>
                                <th scope="col">Added By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $key => $question)
                            <tr>
                                <td>{{ $key+1 }} </td>
                                <td>{!! $question->question !!} </td>
                                <td>{{ $question->chapter->name ?? '' }} - {{ $question->chapter->subject->name ?? '' }} </td>
                                <td>{{ $question->user->name ?? '' }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
