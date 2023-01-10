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
                Manual Attendance
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active"><i class="fa fa-users"></i> Attendance</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Manual Attendance</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('attn.manualentry') }}" method="post">
                        @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" name="date" id="" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Employee</label>
                                @php
                                    $employee = DB::table('employees')->where('status', true)->get();
                                @endphp
                                    <select name="empid" id="" class="form-control input-sm">
                                        @foreach ($employee as $row)
                                        <option value="{{ $row->empid }}">{{ $row->empid }}-{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Intime</label>
                                <input type="time" name="intime" id="" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Out Time</label>
                                <input type="time" name="outtime" id="" class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-sm pull-right"><i class="fa fa-check"></i> Submit</button>
                </div>
            </form>
            </div>
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
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

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
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
@endpush
