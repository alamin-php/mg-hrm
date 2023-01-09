@extends('layouts.backend.app')
@section('title', 'Present')
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
                Today Present
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
                <div class="col-md-10 col-sm-offset-1">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Attendance Sheet</h3>
                        </div>
                        <div class="box-body">
                            <div class="job-card">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th style="text-align: left">Name</th>
                                            <th style="text-align: left">Designation</th>
                                            <th style="text-align: left">Section</th>
                                            <th>In Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($todayPresent as $row)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td style="text-align: left">
                                                {{ $row->emp_name }}
                                            </td>
                                            <td style="text-align: left">{{ $row->desig_name }}</td>
                                            <td style="text-align: left">{{ $row->section_name }}</td>
                                            <td>
                                                @if (!$row->intime)
                                                    0.0
                                                @else
                                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->intime)->format('h:i a') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (!$row->intime && !$row->outtime)
                                                    <strong class="text-danger">A</strong>
                                                @else
                                                    <strong class="text-success">P</strong>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">

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
