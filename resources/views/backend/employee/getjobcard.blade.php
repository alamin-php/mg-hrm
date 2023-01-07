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
                <h3 class="box-title">Employee Job Card</h3>
                <a href="{{ route('attn.jobcard')}}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-search"></i> Search More</a>
            </div>
            <div class="box-body">
                <div class="emp-details">
                <p>ID No: {{$employee->empid}}</p>
                <p>Name: {{$employee->name}}</p>
                <p>Designation: Asst. Manager</p>
                </div>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Late</th>
                            <th>Erlyout</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($search as $row)
                        <tr>
                            {{-- <td>{{ $row->date}}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($row->date)->format('d-M-Y')}}</td>
                            <td>
                                @if (!$row->intime)
                                    0.00
                                @else
                                {{ \Carbon\Carbon::parse($row->intime)->format('h:m A')}}
                                @endif
                            </td>
                            <td>
                                @if (!$row->outtime)
                                    0.00
                                @else
                                {{ \Carbon\Carbon::parse($row->outtime)->format('h:m A')}}
                                @endif
                            </td>
                            <td>
                                @if (!$row->late)
                                    0.00
                                @else
                                {{ $row->late}}
                                @endif
                            </td>
                            <td>
                                @if (!$row->erlayout)
                                    0.00
                                @else
                                {{ \Carbon\Carbon::parse($row->erlayout)->format('h:m')}}
                                @endif
                            </td>
                            <td>
                                @if (!$row->intime && !$row->outtime)
                                    <strong class="text-danger">Absent</strong>
                                    @else
                                    <span class="text-success">Present</span>
                                @endif
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


        </section>
        <!-- /.content -->
    </div>
        @endsection

    @push('js')

    @endpush
