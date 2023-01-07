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
                    <h3 class="box-title">All Employee</h3>
                    <a href="" class="btn btn-primary btn-sm pull-right addModal" data-toggle="modal"
                        data-target="#addModal"><i class="fa fa-plus"></i> Create</a>
                    <a href="" class="btn btn-primary btn-sm pull-right uploadModal" data-toggle="modal"
                        data-target="#uploadModal"><i class="fa fa-plus"></i> Upload</a>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-sm ytable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Section</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Action</th>
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
    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Add Employee</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employee.store') }}" method="post" id="add_form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unitName">Unit</label>
                                    <select name="unit_id" id="" class="form-control form-control-sm">
                                        <option value="">--Select--</option>
                                        @foreach ($unit as $row)
                                            <option value="{{ $row->id }}">{{ $row->unit_name }}</option>
                                        @endforeach
                                        <span class="text-danger error-text unit_id_error"></span>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sectionName">Section</label>
                                    <select name="section_id" id="" class="form-control form-control-sm">
                                        <option value="">--Select--</option>
                                        @foreach ($section as $row)
                                            <option value="{{ $row->id }}">{{ $row->section_name }}</option>
                                        @endforeach
                                        <span class="text-danger error-text section_id_error"></span>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unitName">Designation</label>
                                    <select name="desig_id" id="" class="form-control form-control-sm">
                                        <option value="">--Select--</option>
                                        @foreach ($desig as $row)
                                            <option value="{{ $row->id }}">{{ $row->desig_name }}</option>
                                        @endforeach
                                        <span class="text-danger error-text desig_id_error"></span>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="empName">Employee name</label>
                                    <input type="text" name="name" id="empName" class="form-control form-control-sm"
                                        placeholder="Enter employeename">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Add Employee</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('excel.import') }}" method="post" id="upload_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="upload">Upload Attan.</label>
                                    <input type="file" name="att_upload" id="upload"
                                        class="form-control form-control-sm">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit Employee</h4>
                </div>
                <div class="modal-body">
                    <div id="edit_model_body"></div>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script src="{{ asset('public/backend') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('public/backend') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="{{ asset('public/backend') }}/bower_components/PACE/pace.min.js"></script>
        <script>
            // Section table
            $(function Section() {
                table = $('.ytable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('employee.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'unit_name',
                            name: 'unit_name'
                        },
                        {
                            data: 'section_name',
                            name: 'section_name'
                        },
                        {
                            data: 'desig_name',
                            name: 'desig_name'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            });
            // // store a new user
            $(document).ready(function() {
                $('#add_form').submit(function(e) {
                    e.preventDefault();
                    let spinner = '<span><i class="fa fa-spin fa-refresh"></i> Saving...</span>';
                    let url = $(this).attr('action');
                    let request = $(this).serialize();
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: request,
                        beforeSend: function() {
                            $(document).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
                                $.each(data.error, function(prefix, val) {
                                    $('span.' + prefix + '_error').text(val[0]);
                                });
                            } else {
                                $('#btnSubmit').html(spinner);
                                toastr.success(data);
                                $('#add_form')[0].reset();
                                $('#addModal').modal('hide');
                                $('#btnSubmit').text('Submit');
                                table.ajax.reload();
                            }
                        }
                    });
                });
            });
            //Upload excel
            $(document).ready(function() {
                $('#upload_form').submit(function(e) {
                    e.preventDefault();
                    let spinner = '<span><i class="fa fa-spin fa-refresh"></i> Saving...</span>';
                    let url = $(this).attr('action');
                    let request = $(this).serialize();
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: request,
                        beforeSend: function() {
                            $(document).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
                                $.each(data.error, function(prefix, val) {
                                    $('span.' + prefix + '_error').text(val[0]);
                                });
                            } else {
                                $('#btnSubmit').html(spinner);
                                toastr.success(data);
                                $('#add_form')[0].reset();
                                $('#addModal').modal('hide');
                                $('#btnSubmit').text('Submit');
                                table.ajax.reload();
                            }
                        }
                    });
                });
            });
            // create data
            $('body').on('click', '.addModal', function() {
                $('#add_form')[0].reset();
            });
            // Edit data
            $('body').on('click', '.edit', function() {
                let id = $(this).data('id');
                console.log(id);
                $.get('employee/edit/' + id, function(data) {
                    $("#edit_model_body").html(data);
                })
            });
            // status update
            $(document).on('click', '.update_status', function() {
                let id = $(this).data('id');
                let url = "{{ url('employee/status_update') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(data) {
                        toastr.success(data);
                        table.ajax.reload();
                    }
                });
            });
            // Delete data
            $(document).ready(function() {
                $(document).on('click', '#delete_employee', function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    $('#deleted_form').attr('action', url);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#deleted_form").submit();
                        }
                    })
                });
                //delete action apply
                $('#deleted_form').submit(function(e) {
                    e.preventDefault();
                    var url = $(this).attr('action');
                    var request = $(this).serialize();
                    $.ajax({
                        url: url,
                        type: 'post',
                        async: false,
                        data: request,
                        success: function(data) {
                            toastr.success(data);
                            $('#deleted_form')[0].reset();
                            table.ajax.reload();
                        }
                    });
                });
            });

            // // Data update
            // $(document).ajaxStart(function() {
            //     Pace.restart();
            // });
        </script>
    @endpush
