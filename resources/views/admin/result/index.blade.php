@extends('admin.layouts.master')

@section('title', 'Results History')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Results History</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Results History</li>
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
                <div class="table-responsive">
                    <table id="resultTable" class="table table-centered table-nowrap table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">User</th>
                                <th scope="col">Score</th>
                                <th scope="col">Date/Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $result)
                            {{-- {{ dd($result) }} --}}

                            <tr>
                                <td>
                                    @if($result->test_type)
                                    Category Test 
                                    @else 
                                    Dynamic Test
                                    @endif
                                </td>
                                <td>
                                    {{ $result->user->name ?? '' }}
                                </td>
                                <td>
                                    @php 
                                        $score = \App\Helpers\ResultCalculator::find($result->id);

                                    @endphp 
                                    <b><i class="fa fa-check text-success"></i> Correct : </b> {{ $score['correct'] ?? '' }} <br>
                                    <b><i class="fa fa-times text-danger"></i> Wrong : </b> {{ $score['wrong'] ?? '' }} <br>
                                    <b><i class="fa fa-forward"></i> Skipped : </b> {{ $score['skippedAns'] ?? '' }}

                                </td>
                                <td>
                                    {{ $result->created_at }}
                                </td>
                                
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

@push('script')
<script>
    $(document).ready(function(){
        $('#resultTable').DataTable();
    });
</script>
@endpush
