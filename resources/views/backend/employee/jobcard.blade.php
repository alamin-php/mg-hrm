@extends('layouts.backend.app')
@section('title', 'Section')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/pace/pace.min.css">
    <link rel="stylesheet"
        href="{{ asset('public/backend') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Job Card
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active"><i class="fa fa-users"></i> Job Card</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-sm-offset-2">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Search Job Card</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <form action="{{ route('search.jobcard') }}" method="POST">
                                    @csrf
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="upload">Select Employee</label>
                                            <select name="empid" id="" class="form-control input-sm">
                                                @php
                                                    $empname = DB::table('employees')
                                                        ->select('empid', 'name')
                                                        ->where('status', true)
                                                        ->get();
                                                @endphp
                                                <option value="">Select One</option>
                                                @foreach ($empname as $row)
                                                    <option value="{{ $row->empid }}" required>
                                                        {{ $row->empid }}-{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="upload">From date</label>
                                            <input type="date" name="frm_date" placeholder="Enter id no"
                                                class="form-control input-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="upload">To date</label>
                                            <input type="date" name="to_date" placeholder="Enter id no"
                                                class="form-control input-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="upload">Status</label>
                                                <select name="" id="" class="form-control input-sm">
                                                    <option value="">==Select One==</option>
                                                    <option value="">Present</option>
                                                    <option value="">Absent</option>
                                                    <option value="">Late</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-search"></i>
                                Search Job Card</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection

@push('js')
    <script></script>
@endpush
