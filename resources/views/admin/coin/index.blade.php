@extends('admin.layouts.master')

@section('title', 'Coins History')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Coins History</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Coins History</li>
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
                    <table id="coinTable" class="table table-centered table-nowrap table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Coin Activity Log</th>
                                <th scope="col">Credit</th>
                                <th scope="col">Date/Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coins as $coin)
                            <tr>
                                <td>
                                    @if($coin->total_amount > 0)
                                    {{ $coin->user->name ?? '' }} has purchased 
                                    <span class="text-success">{{ $coin->total_coins }} coins</span> 
                                    via {{ $coin->paymentMethod->name ?? 'x' }}.
                                    @else 
                                    {{ $coin->user->name ?? '' }} has earned 
                                    <span class="text-success">{{ $coin->total_coins }} coins</span>.
                                    @endif
                                </td>
                                <td>
                                    <span class="text-success">+{{ $coin->total_amount }} Pkr</span>
                                </td>
                                <td>
                                    {{ $coin->created_at }}
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
        $('#coinTable').DataTable();
    });
</script>
@endpush
