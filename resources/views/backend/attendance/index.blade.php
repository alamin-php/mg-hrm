@extends('layouts.backend.app')
@section('title', 'Attendance')
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
                Employee
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active"><i class="fa fa-users"></i> Employee</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All Attn</h3>
                    <a href="" class="btn btn-primary btn-sm pull-right addModal" data-toggle="modal"
                        data-target="#addModal"><i class="fa fa-plus"></i> Create</a>
                </div>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-sm ytable">
                        <thead>
                            <tr>
                                <th>Employee Id</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>Late</th>
                                <th>Erlyout</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>
                                <td width="30px">{{ $row->empid}}</td>
                                <td>{{ $row->date}}</td>
                                <td>{{ $row->name}}</td>
                                <td>
                                    @if (!$row->intime)
                                        0.00
                                    @else
                                    {{ $row->intime}}
                                    @endif
                                </td>
                                <td>
                                    @if (!$row->outtime)
                                        0.00
                                    @else
                                    {{ $row->outtime}}
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
                                    {{ $row->erlayout}}
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
                    <form id="deleted_form" action="" method="delete">
                        @csrf @method('DELETE')
                    </form>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>

    @endsection

    @push('js')
        <script src="{{ asset('public/backend') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('public/backend') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="{{ asset('public/backend') }}/bower_components/PACE/pace.min.js"></script>
        <script>
            $(function () {
              $('#example1').DataTable()
              $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
              })
            })
          </script>
    @endpush
