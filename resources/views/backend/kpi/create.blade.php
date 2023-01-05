@extends('layouts.backend.app')
@section('title', 'KPI')
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
                Section
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active"><i class="fa fa-home"></i> KPI</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All KPI</h3>
                    <a href="{{ route('kpi.index') }}" class="btn btn-default btn-sm pull-right"><i class="fa fa-undo"></i> Back</a>
                </div>
                <div class="box-body">
                    <form action="{{ route('kpi.store') }}" method="post" id="add_data">
                        @csrf
                    <table class="table table-bordered table-sm ytable" id="table_field">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Particular</th>
                                <th>Starting Times</th>
                                <th>Ending Times</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="date" class="form-control input-sm" name="kpi_date[]" required></td>
                                <td><input type="text" class="form-control input-sm" name="particular[]" required></td>
                                <td><input type="text" class="form-control input-sm" name="s_time[]" required></td>
                                <td><input type="text" class="form-control input-sm" name="e_time[]" required></td>
                                <td><input type="text" class="form-control input-sm" name="remarks[]" required></td>
                                <td><input type="button" class="btn btn-success btn-flat btn-sm" name="add" id="add" value="Add"></td>
                            </tr>
                        </tbody>
                    </table>
                    <center>
                        <button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">Submit</button>
                    </center>
                    </form>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    @endsection

    @push('js')
        <script>
            $(document).ready(function(){
                var html = '<tr><td><input type="date" class="form-control input-sm" name="kpi_date[]" required></td><td><input type="text" class="form-control input-sm" name="particular[]" required></td><td><input type="text" class="form-control input-sm" name="s_time[]" required></td><td><input type="text" class="form-control input-sm" name="e_time[]" required></td><td><input type="text" class="form-control input-sm" name="remarks[]" required></td><td><button name="remove" id="remove" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-remove"></i></button></td></tr>';

                var limit=5;
                $("#add").click(function(){
                    var trs = $('*tbody>tr');
                    if(limit >= trs.length){
                        $("#table_field").append(html);
                    }
                });
                $("#table_field").on('click', '#remove', function(){
                    $(this).closest('tr').remove();
                });
            });

            $(document).ready(function() {
                $('#add_data').submit(function(e) {
                    e.preventDefault();
                    let url = $(this).attr('action');
                    let request = $(this).serialize();
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: request,
                        success: function(data) {
                                toastr.success(data);
                                $('#add_data')[0].reset();
                                $('tbody').find('tr:gt(0)').remove();
                                var x=1;
                                x++;
                            },
                            // $('#btnSubmit').on('click', function(){
                            // });
                    });
                });
            });
        </script>
    @endpush
